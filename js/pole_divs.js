$(document).ready(function ()
	{
		var tabs = $("#tabs_pole ul li");
		//tabs.first().addClass("active");
		//  $("#tabs_pole_container .tab_content").first().fadeIn();
    //  When user clicks on tab, this code will be executed
   tabs.click(function() {
        //  First remove class "active" from currently active tab
        tabs.removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Hide all tab content
        $("#tabs_pole_container .tab_content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        //  Show the selected tab content
        $(selected_tab).fadeIn();
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
	var clicksend = function() {

            //get currently-on tab
        var onTab = tabs.filter('.active');

            //click either next tab, if exists, else first one
        var nextTab = onTab.index() < tabs.length-1 ? onTab.next() : tabs.first();
        nextTab.click();
    }
	});