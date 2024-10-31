(function($) {
  var form = $('#nav-menu-meta');

  form.find('.query').bind('wp-add-menu-item', function(e, processMethod) {
    var post_type_or_taxonomy  = $(this).find('select').val();
    var id    = $(this).find('#post_type_or_taxonomy_id').val();
    var title = $(this).find('#post_type_or_taxonomy_title').val();
    var type;

    params = { action: 'query' }

    if (post_type_or_taxonomy == 'taxonomy') {
      params['cat'] = id;
    } else { 
      params['p'] = id;
    }

    var img = $(this).find('img.waiting').show();
    $.get(ajaxurl, params, function(data) {
      if (data.length == 0) {
        return;
      }

      if ($('#post_type_or_taxonomy_title').hasClass('input-with-default-title') || title == '') {
        title = data['title'];
      }

      menuItem = {
        '-1': {
          'menu-item-type': post_type_or_taxonomy,
          'menu-item-url': data['permalink'],
          'menu-item-object': data['type'],
          'menu-item-object-id': data['id'],
          'menu-item-title': title,
          'menu-item-db-id': 0,
          'menu-item-parent-id': 0
        }
      }

      wpNavMenu.addItemToMenu(menuItem, processMethod, function() {
        img.hide();
      });
    }, 'json');
  });
})(jQuery);
