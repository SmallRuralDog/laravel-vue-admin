function getArrayValue(data, path, level) {
    let index = level + 1;
    let key = path[index]
    if (!window._.isArray(data)) {
        return [data[key]];
    }
    let allData = data.map((item) => {
        let itemData = item[key]
        if (window._.isArray(itemData)) {
            return getArrayValue(itemData, path, index)
        } else {
            return itemData;
        }
    })
    return allData;
}


function flattenDeepChild(data, child_key, key) {
    let arr = data.map(item => {


        let arr = []
        let itemData = item[key]
        arr.push(itemData)
        let v = item[child_key];
        if (v) {
            arr.push(flattenDeepChild(item[child_key], child_key, key))
        }
        return window._.flattenDeep(arr);
    })

    return window._.flattenDeep(arr);
}



function getFileUrl(host, path) {

    if (path.indexOf("//") >= 0) {
        return path;
    } else {
        return host + path;
    }
}

function getFileName(path) {

    try {
        let pathInfo = path.split('/')

        return pathInfo[pathInfo.length - 1]

    } catch (error) {
        return ""
    }

}

function isNull(argument) {
    const type = typeof argument
    switch (type) {
        case 'object':
            return window._.isEmpty(argument)
        case 'array':
            return argument.length
        default:
            return argument === "" || argument === null || argument === undefined
    }
}

export {
    getArrayValue,
    flattenDeepChild,
    getFileUrl,
    getFileName,
    isNull
}
