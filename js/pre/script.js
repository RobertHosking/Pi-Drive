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
function focus_this(obj, session){
   setTimeout(function(){
      var selected = $(':focus');
      var name = selected.attr('id');
      if(selected.hasClass('folder')){
        var options = '<div id="'+name+'"><button class="btn btn-default" data-toggle="modal" data-target="#renameModal">Rename</button><button class="btn btn-danger" data-toggle="modal" data-target="#trashModal">Move to Trash</button></div>';
        $('#file-options').html(options);
        var param = '<input type="hidden" name="folderTarget" value="'+name+'" />';
        $('.target').html(param);
      }
   }, 150);
}
function focus_lost(){
  setTimeout(function(){ $('#file-options').html(''); }, 100);
}

$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});
