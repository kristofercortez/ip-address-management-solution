let toastOptions = window.toastOptions = global.toastOptions = {
    closeButton: true,
    positionClass: 'toast-top-right',
    onclick: null,
    showDuration: 500,
    hideDuration: 500,
    timeOut: 5000,
    extendedTimeOut: 5000,
    progressBar: true,
};

global.common = {
    init: function () {
        common.setToasterOptions();
    },

    setToasterOptions: function (positionClass) {
        toastr.options = global.toastOptions;
        if (positionClass) {
            global.toastOptions.positionClass = positionClass;
        }
    },

    showToast: function (type, title, message, options) {
        if (!options) {
            options = global.toastOptions;
        }
        toastr[type](title, message, options);
    },

    showToastSuccess: function (title, message, options) {
        if (!options) {
            options = global.toastOptions;
        }
        toastr['success'](message, title, options);
    },

    showToastError: function (title, message, options) {
        if (!options) {
            options = global.toastOptions;
        }
        toastr['error'](message, title, options);
    },

    showToastWarning: function (title, message, options) {
        if (!options) {
            options = global.toastOptions;
        }
        toastr['warning'](message, title, options);
    },

    showToastInfo: function (title, message, options) {
        if (!options) {
            options = global.toastOptions;
        }
        toastr['info'](message, title, options);
    },

    showToastTour: function (title, message, options) {
        if (!options) {
            options = {
                closeButton: true,
                positionClass: 'toast-top-right',
                onclick: null,
                timeOut: 0,
                extendedTimeOut: 0,
                progressBar: false,
                showEasing: 'swing',
                showMethod: 'slideDown',
                tapToDismiss: false,
            };
        }
        toastr['info'](message, title, options);
    },

    formatDate: function formatDate(date) {
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        return day + "-" + month + "-" + year;
    },

    capitalizeFirstCharacter: function (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    },
};

$(function () {
    common.init();
});