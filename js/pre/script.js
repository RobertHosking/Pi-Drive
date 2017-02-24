$('.navbar-lower').affix({
  offset: {top: 65}
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
        var options = '<div class="options" id="'+name+'"><a style="cursor: pointer;" data-toggle="modal" data-target="#moveModal"><i  class="fa fa-sign-out"></i> Move</a><br>'+
        '<a style="cursor: pointer;" data-toggle="modal" data-target="#renameModal"><i  class="fa fa-pencil-square-o "></i> Rename</a><br>'+
        '<a style="cursor: pointer;" data-toggle="modal" data-target="#trashModal"><i class="fa fa-trash"></i> Trash</a></div>';
        $('#file-options').html(options);
        var param = '<input type="hidden" name="target" value="'+name+'" />';
        $('.target').html(param);
      }
   }, 150);
}

$(".poster").hover(function(){
  console.log("asdfad");
    var name = $(this).attr("id");
    var param = '<input type="hidden" name="target" value="'+name+'" />';
    $('.target').html(param);
});

function focus_lost(){
  setTimeout(function(){ $('#file-options').html(''); }, 100);
}

$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});


