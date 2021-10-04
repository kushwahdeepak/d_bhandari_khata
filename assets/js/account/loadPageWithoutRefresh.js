function loadPageWithoutRefresh(loadUrl="") 
{
    $.ajaxSetup ({
        cache: false
    });

    $("#resultBody").load(loadUrl+"/ajax");
    if(loadUrl!=window.location)
    {
        window.history.pushState({path:loadUrl},'',loadUrl);
    }
}