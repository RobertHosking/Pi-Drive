$('.navbar-lower').affix({
  offset: {top: 65}
});

$( document ).ready( function(){
    
    $('.grid').masonry({
  // set itemSelector so .grid-sizer is not used in layout
  itemSelector: '.grid-item',
  // use element for option
  columnWidth: '.grid-sizer',
  percentPosition: true
});
});

function change_dir(dir){
    $.post('/dir-controller.php', { ch_dir: dir},
    
      function(data){
        console.log(data);
      });
}
function online(bool){
    $.post('/toggle-online.php', { online: bool},
      function(data){
        console.log(data);
      });
}

function reload(){
    setTimeout(function(){
               window.location.reload();
        }, 100); 
}
function focus(obj){
    $(obj).removeClass('btn-secondary');
    $(obj).addClass('btn-info');

}
