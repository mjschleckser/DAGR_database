document.addEventListener('DOMContentLoaded', function() {
  var checkPageButton = document.getElementById('addPage');
  checkPageButton.addEventListener('click', function() {

    chrome.tabs.getSelected(null, function(tab) {
      $url = window.location.href;
      post_page_without_parent($url);
    });
  }, false);
}, false);


chrome.tabs.query({active: true, currentWindow: true}, function(arrayOfTabs) {

     // since only one tab should be active and in the current window at once
     // the return variable should only have one entry
    var activeTab = arrayOfTabs[0];
	 
	var url = activeTab.url;
	document.getElementById('php_container').innerHTML = 
		'<iframe width="100%" height="100%" frameborder="0" src="http://localhost/DAGR_database/extension_interface.php?url='+url+'"></iframe>';

});
  
