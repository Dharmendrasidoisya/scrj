$(() => {
    'use strict'

    BDashboard.loadWidget($('#widget_projectsposts_recent').find('.widget-content'), route('projectsposts.widget.recent-projectsposts'))
})
