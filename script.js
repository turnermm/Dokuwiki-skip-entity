if (typeof window.toolbar !== 'undefined') {
    toolbar[toolbar.length] = {
        type: "picker",
        title: "Skip Entity",
        icon: '../../plugins/skipentity/skent.png',
        key: "",
        list:[{"type":"format","title":"white","icon":"..\/..\/plugins\/skipentity\/tt-w.png","open":"```","close":"```"},
        {"type":"format","title":"gray","icon":"..\/..\/plugins\/skipentity\/tt-g.png","open":"``","close":"``"}]
    };
}