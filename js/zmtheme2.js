document.addEventListener('DOMContentLoaded', function() {
    zmNoFullAlignClasstoBody();
    zmtAjaxPostsLoader();
    zmtaccessibilityTweak();
});

function zmNoFullAlignClasstoBody() {
    if (document.querySelector('.zm-no-full-align')) {
        document.body.classList.add('no-align-widenfull');
    }
}


    /**
     * Funktioniert nicht richtig, der 2. post wird im loop nicht hinzugefügt und der ajax button auch nicht für weitere posts... 
     * benötigt noch weitere tests bis richtig funktioniert!!!
     * ---> AjaxPostsLoader2 muss verwendet werden!
     * ---> zmtheme2.js muss aktiviert werden
     * ---> ev muss in render.php auch etwas angepasst werden
     * fetch api wäre besser, da ohne jquery...
     * --> scroll funktioniert auch nicht.
     */
function zmtAjaxPostsLoader() {
    document.querySelectorAll('.zmt-ajax-posts-load-container').forEach(function(container) {
        container.style.display = 'block';
    });

    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('zmt-ajax-posts-load-button')) {
            event.preventDefault();

            var button = event.target;
            var container = button.closest('.zmt-ajax-posts-load-container');
            container.querySelector('.zmt-ajax-posts-load-button').style.display = 'none';
            container.querySelector('.zmt-ajax-posts-loading-button').style.display = 'block';

            var queryData = {
                query: container.dataset.zmtQuery,
                maxpages: container.dataset.zmtMaxpages,
                current: container.dataset.zmtCurrent,
                comid: container.dataset.zmtComid,
            };

            var ajaxData = new FormData();
            ajaxData.append('action', 'zmt_ajax_posts_loader');
            ajaxData.append('query_data', JSON.stringify(queryData));
            ajaxData.append('security', zmt_global_vars.ajaxnonce);

            fetch(zmt_global_vars.ajaxurl, {
                method: 'POST',
                body: ajaxData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {
                if (response.success) {

                    var articleListContainer = document.querySelector('.' + response.data.comid + '-ajax-button-container').parentElement;
                    
                    var ajaxbutton = document.querySelector('.' + response.data.comid + '-ajax-button-container');
                    ajaxbutton.remove();

                    var newContent = document.createElement('div');
                    newContent.innerHTML = response.data.html;
                    var newElementsx = newContent.childNodes;

                    console.log(newElementsx.length);
                    console.log(newElementsx[0]);
                    console.log(newElementsx[1]);
                    console.log(newElementsx[2]);

                    /*var numberofchildren = newElementsx.length;
                    
                    for (let n = 0; n < numberofchildren; n++) {
                        console.log(n);
                        console.log(newElementsx[n]);
                        articleListContainer.appendChild(newElementsx[n]);
                    }*/


                    newElementsx.forEach((item) => {
                        articleListContainer.appendChild(item);
                    });

                    //ajaxbutton.replaceWith(newElements);

                    /*var newContent = document.createElement('div');
                    newContent.innerHTML = response.data.html;
                    console.log(response.data.html);
                    var newElements = newContent.firstChild;
                    newElements.style.display = 'none';
                    document.querySelector('.' + response.data.comid + '-ajax-button-container').replaceWith(newElements);
                    newElements.style.display = 'block';*/

                    /*document.querySelectorAll('.zmt-ajax-posts-load-container').forEach(function(container) {
                        container.style.display = 'block';
                    });

                    var scrollToElement = articleListContainer.querySelector('#' + response.data.next_post_id);
                    window.scrollTo({
                        top: scrollToElement.offsetTop,
                        behavior: 'smooth'
                    });*/
                    
                }
            });
        }
    });
}

function zmtaccessibilityTweak() {
    document.querySelectorAll('.uk-close svg').forEach(svg => {
        svg.setAttribute('aria-hidden', 'true');
    });
}