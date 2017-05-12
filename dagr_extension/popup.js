document.addEventListener('DOMContentLoaded', function() {
  var checkPageButton = document.getElementById('addPage');
  checkPageButton.addEventListener('click', function() {

    chrome.tabs.getSelected(null, function(tab) {
      $url = window.location.href;
      post_page_without_parent($url);
    });
  }, false);
}, false);