if (typeof window.toolbar !== 'undefined') {
    toolbar[toolbar.length] = {
        type: "picker",
        title: "Skip Entity",
        icon: '../../plugins/skipentity/skent.png',
        key: "",
        list:[
        {
            "type":"format",
            "title":LANG.plugins.skipentity.w_title,
            "icon":"..\/..\/plugins\/skipentity\/tt-w.png",
            "open":"```",
            "close":"```"
         },
        {
        "type":"format",
        "title":LANG.plugins.skipentity.g_title,
        "icon":"..\/..\/plugins\/skipentity\/tt-g.png",
        "open":"``",
        "close":"``"
         }
      ]
    };
}