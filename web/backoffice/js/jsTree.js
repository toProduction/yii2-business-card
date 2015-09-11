$(function () {
    $('#jstree').jstree({
        core: {
            "check_callback": true,
            "themes": {
                "variant": "large"
            },
        },
        types: {
            "link": {
                "icon": "glyphicon glyphicon-link"
            },
            "page": {
                "icon": "glyphicon glyphicon-file"
            }
        },
        plugins: ["dnd", "types"]
    }).bind("move_node.jstree", function (event, data) {
        var movedItemOptions = data.node.data;
        var movedItemAattr = data.node.a_attr;

        console.log(data);
        $.post(movedItemAattr.href, {
            MenuItem: {
                id: data.node.id,
                menu_id: movedItemOptions.jstree.menu_id,
                position: data.position,
                oldPosition: data.old_position,
                parent_id: (data.parent != '#' ? data.parent : 0),
                oldParent: data.old_parent
            }
        }, function (data) {

        }, 'json');
    }).bind("select_node.jstree", function (e, data) {
        $.get(data.node.a_attr.href, function (data) {
            console.log(data);
            $('#lunchModalJsTree .modal-body').html(data);
            $('#lunchModalJsTree').modal();
        });
    });
});