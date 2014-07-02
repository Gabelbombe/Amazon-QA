// JavaScript Document

/*************************************************
 Based on the Star Rating System by Ritesh Agrawal
 http://php.scripts.psu.edu/rja171/widgets/rating.js
 ************************************************/

$.fn.rate = function(url, opts) {

    if(null === url) return;

    var settings =
    {
        url   : url,   // post changes to
        inc   : 1,     // value to increment by
        max   : 5,     // max number of stars
        cur   : 0      // number of selected stars
    };

    if(opts)
    {
        $.extend(settings, opts);
    };

    $.extend(settings,
    {
        cancel: (settings.max > 1) ? true : false
    });

    var container = $(this);

    $.extend(container,
    {
        avg: settings.cur,
        url: settings.url
    });

    settings.inc = (settings.inc < .75) ? .5 : 1;

    var s = 0;
    for(var i= 0; i <= settings.max ; i++)
    {
        if (0 === i)
        {
            if(true === settings.cancel)
            {
                var div = '<div class="cancel"><a href="#0" title="Cancel Rating">Cancel Rating</a></div>';
                container.empty().append(div);
            }
        } else {

            var $div = $('<div class="star"></div>')
                .append('<a href="#'+i+'" title="Give it '+i+'/'+settings.max+'">'+i+'</a>')
                .appendTo(container);

            if (.5 === settings.inc)
            {
                $div.addClass((s % 2) ? 'star-left' : 'star-right');
            }
        }
        i = (i - 1 + settings.inc);
        s++;
    }

    var stars = $(container).children('.star');
    var cancel = $(container).children('.cancel');

    stars
        .mouseover(function ()
        {
            event.drain();
            event.fill(this);
        })
        .mouseout(function ()
        {
            event.drain();
            event.reset();
        })
        .focus(function ()
        {
            event.drain();
            event.fill(this);
        })
        .blur(function ()
        {
            event.drain();
            event.reset();
        });

    stars.click(function ()
    {
        if (true === settings.cancel)
        {
            console.log($(this).val('data-var'));

            settings.cur = (stars.index(this) * settings.inc) + settings.inc;

            $.post(container.url,
            {
                "rate": $(this).children('a') [0].href.split('#') [1],
                "data": $(this).parent('div').data('id')
            });

            return false;
        }

        else if (1 === settings.max)
        {
            settings.cur = (0 === settings.cur) ? 1 : 0;

            $(this).toggleClass('on');

            $.post(container.url,
            {
                "rate": $(this).children('a') [0].href.split('#') [1],
                "data": $(this).parent('div').data('id')
            });

            return false;
        }
        return true;
    });

    // cancel button events
    if(cancel)
    {
        cancel
            .mouseover(function ()
            {
                event.drain();
                $(this).addClass('on');
            })
            .mouseout(function ()
            {
                event.reset();
                $(this).removeClass('on');
            })
            .focus(function ()
            {
                event.drain();
                $(this).addClass('on');
            })
            .blur(function ()
            {
                event.reset();
                $(this).removeClass('on');
            });

        // click events.
        cancel.click(function ()
        {
            event.drain();
            settings.cur = 0;
            $.post(container.url,
            {
                "rate": $(this).children('a')[0].href.split('#') [1],
                "data": $(this).parent('div').data('id')
            });

            return false;
        });
    }

    var event =
    {
        fill: function (el)
        {   // fill to the current mouse position.
            var index = stars.index(el) + 1;
            stars
                .children('a').css('width', '100%').end()
                .slice(0,index).addClass('hover').end();
        },
        drain: function ()
        {   // drain all the stars.
            stars
                .filter('.on').removeClass('on').end()
                .filter('.hover').removeClass('hover').end();
        },
        reset: function ()
        {   // Reset the stars to the default index.
            stars
                .slice(0,settings.cur / settings.inc)
                .addClass('on').end();
        }
    };
    event.reset();
    return(this);
};