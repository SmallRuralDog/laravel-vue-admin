<?php


namespace SmallRuralDog\Admin\Console;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class ExtendCommand extends Command
{
    use AcceptsNameAndVendor;

    protected $signature = 'admin:extend {name}';

    protected $description = '创建扩展';

    public function handle()
    {
        if (!$this->hasValidNameArgument()) {
            return;
        }

        (new Filesystem)->copyDirectory(
            __DIR__ . '/extend-stubs',
            $this->extendPath()
        );

        $this->replace('{{ component }}', $this->extendName(), $this->extendPath() . '/resources/js/extend.js');


        $this->replace('{{ namespace }}', $this->extendNamespace(), $this->extendPath() . '/src/ExtendServiceProvider.stub');
        $this->replace('{{ component }}', $this->extendName(), $this->extendPath() . '/src/ExtendServiceProvider.stub');

        (new Filesystem)->move(
            $this->extendPath() . '/src/ExtendServiceProvider.stub',
            $this->extendPath() . '/src/ExtendServiceProvider.php'
        );

        $this->replace('{{ name }}', $this->argument('name'), $this->extendPath() . '/composer.json');
        $this->replace('{{ escapedNamespace }}', $this->escapedExtendNamespace(), $this->extendPath() . '/composer.json');


        $this->addExtendRepositoryToRootComposer();
        $this->addExtendPackageToRootComposer();
        $this->addScriptsToNpmPackage();

        /*if ($this->confirm('Would you like to update your Composer packages?', true)) {
            $this->composerUpdate();
        }*/

    }

    protected function composerUpdate()
    {
        $this->executeCommand('composer update', getcwd());
    }

    protected function executeCommand($command, $path)
    {
        $process = (new Process($command, $path))->setTimeout(null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->run(function ($type, $line) {
            $this->output->write($line);
        });
    }

    protected function addExtendRepositoryToRootComposer()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        $composer['repositories'][] = [
            'type' => 'path',
            'url' => $this->relativeExtendPath(),
        ];

        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    protected function addExtendPackageToRootComposer()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $composer['require'][$this->argument('name')] = '*';
        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    protected function addScriptsToNpmPackage()
    {
        $package = json_decode(file_get_contents(base_path('package.json')), true);
        $package['scripts']['build-' . $this->extendName()] = 'cd ' . $this->relativeExtendPath() . ' && npm run dev';
        $package['scripts']['build-' . $this->extendName() . '-prod'] = 'cd ' . $this->relativeExtendPath() . ' && npm run prod';

        file_put_contents(
            base_path('package.json'),
            json_encode($package, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    protected function replace($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    protected function extendNamespace()
    {
        return Str::studly($this->extendVendor()) . '\\' . $this->extendClass();
    }

    protected function extendPath()
    {
        return config('admin.directory') . '/Extends/' . $this->extendClass();
    }

    protected function relativeExtendPath()
    {
        return config('admin.directory') . '/Extends/' . $this->extendClass();
    }

    protected function escapedExtendNamespace()
    {
        return str_replace('\\', '\\\\', $this->extendNamespace());
    }

    protected function extendClass()
    {
        return Str::studly($this->extendName());
    }

    protected function extendVendor()
    {
        return explode('/', $this->argument('name'))[0];
    }


    protected function extendName()
    {
        return explode('/', $this->argument('name'))[1];
    }
}
