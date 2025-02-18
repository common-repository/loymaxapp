function initSortable(isInstallation = false) {
    jQuery(function ($) {
        $('#loymax-sortable-container').sortable({
            handle: '.lmx-draggable-element',
            update: function (event, ui) {
                var order = $('#loymax-sortable-container').sortable("toArray");
                if (!isInstallation) {
                    var ordersData = {
                        'lmx-action': 'update-menu-orders',
                        orders: order,
                    };
                    $.ajax({
                        type: 'POST',
                        data: $.param(ordersData),
                    });
                } else {
                    var orderInput = document.getElementById('hidden-input-orders');
                    if (orderInput) {
                        orderInput.value = order;
                    }
                }
            }
        }).disableSelection();
    });
}

/**
 * Скрывает форму настроек модуля
 * @param element контейнер настроек
 */
function hideForm(element) {
    element.classList.add('lmx-hidden-form');
}

/**
 * Удаляет уведомление о необходимости настроить ЛК
 */
function deleteNotice() {
    var notice = window.document.getElementById( 'notice-loymax-setup' );
    if (notice) {
        notice.remove();
    }
}

/**
 * Отправляет запрос на отключение мастера установки
 */
jQuery(function ($) {
    $('button#skip-install').click(function () {
        var data = {
            'lmx-action': 'skip-install',
        };
        $.ajax({
            type: 'POST',
            data: $.param(data),
        });
        deleteNotice();
    });
});

/**
 * Устанавливает класс активному табу и сообщетствующей вкладке
 * @param elementId id вкладки
 * @param navItemId id таба
 */
function changeClasses(elementId, navItemId) {
    let element = window.document.getElementById(elementId);
    if (element) {
        element.classList.add('lmx-tab-show');
    }
    let currentNavItem = window.document.getElementById(navItemId);
    if (currentNavItem) {
        currentNavItem.classList.add('router-link-exact-active', 'router-link-active');
    }
}

/**
 * Меняет активный таб и вкладку
 * @param tabName название таба
 */
function changeTab(tabName = null) {
    // Если название вкладки не передано - определяем его из url
    if (tabName === null) {
        let windowLocationArr = window.location.href.split('#/');
        if (windowLocationArr.length >= 2) {
            tabName = windowLocationArr[windowLocationArr.length - 1];
        }
    }

    let tabs = window.document.getElementsByClassName('lmx-config-tab');
    for (let tab of tabs) {
        tab.classList.remove('lmx-tab-show');
    }
    let navItems = window.document.getElementsByClassName('lmx-navigation-tab-link');
    for (let item of navItems) {
        item.classList.remove('router-link-exact-active', 'router-link-active');
    }
    switch (tabName) {
        case 'configs':
            changeClasses('lmx-common-config', 'lmx-nav-configs');
            break;
        case 'api':
            changeClasses('lmx-set-api', 'lmx-nav-api');
            break;
        case 'theme':
            changeClasses('lmx-customify-theme-installer', 'lmx-nav-theme');
            break;
        case 'user-portal':
            changeClasses('lmx-user-portal', 'lmx-nav-user-portal');
            break;
        default:
            changeClasses('lmx-userportal-config', 'lmx-nav-modules');
            break;
    }
}
