jQuery(function ($) {

    // Vars

    const select = $('.posts_filter_top');
    const filterTermsWrapper = $('.posts_filter_bottom');
    const categories = $('.post_categories');
    const filterPanel = $('.posts_filters_panel');
    const visualElementDelete = '.filter_panel_e_delete';
    const postsWrapper = $(".posts_grid_inner");
    const loadMoreButton = $(".load-more-filter");
    const loader = $('.loader-wrapper');
    const reset = $('.blog_reset');

    var controller = null;

    const init = () => {
        visualPanel();
    }

    const popup = (e) => {
        const current = $(e.currentTarget);

        if (current.hasClass('open')) {
            current.removeClass('open');
            current.next(filterTermsWrapper).slideUp('fast', 'linear');
        }

        else {
            current.addClass('open');
            current.next(filterTermsWrapper).slideDown('fast', 'linear');
        }
    }

    const filter = (e) => {
        const currentTarget = $(e.currentTarget);
        const checked = currentTarget.prop('checked');
        const ID = currentTarget.val();

        const currentUrl = window.location.href;
        const url = new URL(currentUrl);

        // Add param to url

        if (checked === true) {
            urlApi(ID);
        }

        else {
            urlApi(ID, false);
        }

        // Request data 

        filterApi();

        // Add visual panel elem

        visualPanel();
    }

    const filterApi = async (loadMore = false, offset = null) => {

        if (controller) {
            controller.abort();
        }

        controller = new AbortController();
        let signal = controller.signal;

        const currentUrl = window.location.href;
        const url = new URL(currentUrl);

        const allParams = url.searchParams.get('cats');

        const data = new FormData();
        if (allParams !== null) data.append('params', allParams);

        if (loadMore == true && offset !== null) {
            data.append('offset', offset);
        }

        data.append('nonce', theme.nonce);
        data.append('action', 'blog_filter');

         // Loader 

         loader.show();

        const request = await fetch(theme.ajaxUrl, {
            method: "POST",
            body: data,
            signal,
        });

        if (!request.ok) {
            throw new Error(`HTTP error! status: ${request.status}`);
        }

        const posts = await request.json();

        controller = null;
        loader.hide();

        if (posts) {
            if (posts.status === 1) {
                if (loadMore !== true) postsWrapper.html('');
                postsWrapper.append(posts.html);

                // Update offset

                if (loadMore === true) {
                    const offset = postsWrapper.children().length;
                    url.searchParams.set('offset', offset);
                    history.pushState({}, "", url);
                }
            }

            else {
                if (loadMore === false) {

                    // No results

                    postsWrapper.html("");
                    postsWrapper.html('<p class="filter_no_results"> No results for the given terms. </p>')
                }
            }

        }

        // Hide Load More When Needed

        const total = postsWrapper.children().length;

        if(total >= posts.total) {
            loadMoreButton.addClass('hidden');
        }

        else {
            loadMoreButton.removeClass('hidden');
        }
    }

    const urlApi = (cat, append = true) => {
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);

        url.searchParams.delete('offset');

        if (append === true) {
            const oldParams = url.searchParams.get('cats');

            if (oldParams !== null) {
                const newParams = oldParams.split('-');
                if (newParams.includes(cat) === false) newParams.push(cat);
                url.searchParams.set('cats', newParams.join('-'));
            }
            else {
                url.searchParams.set('cats', cat);
            }
        }

        else {
            const allParams = url.searchParams.get('cats');
            if (allParams !== null) {
                const allParamsSplit = allParams.split('-');
                if (allParamsSplit.includes(cat)) {
                    const indexToDelete = allParamsSplit.indexOf(cat);
                    allParamsSplit.splice(indexToDelete, 1);

                    if (allParamsSplit.length) {
                        url.searchParams.set('cats', allParamsSplit.join('-'));
                    }

                    else {
                        url.searchParams.delete('cats');
                    }
                }
            }

        }

        history.pushState({}, "", url);
    }

    const loadMoreApi = (e) => {
        e.preventDefault();
        const offset = postsWrapper.children().length;
        filterApi(true, offset);
    }

    const visualPanel = () => {
        filterPanel.html('');
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        const allParams = url.searchParams.get('cats');
        if (allParams !== null) {
            const allParamsSplit = allParams.split('-');
            allParamsSplit.map((catID) => {
                const visualElem = $(`
                <div> <span class="filter_panel_e_delete">&#10005;</span></div>`
                );
                visualElem.addClass('filter_panel_e');
                const checkbox = $('#' + catID + '');
                visualElem.attr('data-term-id', checkbox.val())
                visualElem.prepend($('label[for="' + checkbox.val() + '"]').text());
                filterPanel.append(visualElem);
            })

            // Reset button

            reset.show();
        }

        else {
            reset.hide();
        }
    }

    const visualPanelDelete = (e) => {
        const current = $(e.currentTarget);
        const currentID = current.closest('.filter_panel_e').data('term-id');
        $("#" + currentID + "").trigger('click');
    }

    // Events

    select.on('click', popup);
    categories.on('change', filter);
    $('body').on('click', visualElementDelete, visualPanelDelete);
    loadMoreButton.on("click", loadMoreApi);
    init();

});