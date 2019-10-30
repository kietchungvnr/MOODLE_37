define([], function () {
    window.requirejs.config({
        paths: {
            "kendo": M.cfg.wwwroot + '/local/newsvnr/js/kendo.all.min',
        },
        shim: {
            'kendo': {exports: 'kendo'},
        }
    });
});