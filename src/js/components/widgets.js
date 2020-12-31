document.addEventListener("DOMContentLoaded", () => {
    const widgetCustomCategories = document.querySelector('.widget_custom_categories');

    if (widgetCustomCategories) {
        widgetCustomCategories.querySelectorAll('.children .cat-item').forEach((child) => {
            let check = child.querySelector('.children');
            if (check) {
                child.classList.add('has-children');
            }
        })
    }
})