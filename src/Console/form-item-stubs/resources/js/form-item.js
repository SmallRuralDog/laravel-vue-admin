VueAdmin.booting((Vue, router, store) => {
  Vue.component('form-item-{{ component }}', require('./components/FormItem').default)
})
