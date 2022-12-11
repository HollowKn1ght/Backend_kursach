<?php 
use App\Page;
?>
<!DOCTYPE html>
<html lang="en">

<?php Page::part('head') ?>

<body>
  <!--навигационная панель-->
  <?php Page::part('topbar') ?>

  <!--основное содержимое-->
  <main id="view-panel" style="margin-top:42px">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    ?>
    <?php Page::part($page) ?>
  </main>

  <!--загрузка сайта-->
  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!--окно подтверждения-->
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--универсальное окно-->
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit'
            onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!--окно закрытия-->
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
</body>

<script>
  // функции для загрузки
  window.start_load = function () {
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function () {
    $('#preloader2').fadeOut('fast', function () {
      $(this).remove();
    })
  }
  $(document).ready(function () {
    $('#preloader').fadeOut('fast', function () {
      $(this).remove();
    })
  })

  // функция для предпоказа видео
  window.viewer_modal = function ($src = '') {
    start_load()
    var t = $src.split('.')
    t = t[1]
    if (t == 'mp4') {
      var view = $("<video src='" + $src + "' controls autoplay></video>")
    } else {
      var view = $("<img src='" + $src + "' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
      show: true,
      backdrop: 'static',
      keyboard: false,
      focus: true
    })
    end_load()
  }
  // функция для универсального окна
  window.uni_modal = function ($title = '', $url = '', $size = "") {
    start_load()
    $.ajax({
      url: "views/components/" + $url,
      error: err => {
        console.log()
        alert("An error occured")
      },
      success: function (resp) {
        console.log(resp)
        if (resp) {
          $('#uni_modal .modal-title').html($title)
          $('#uni_modal .modal-body').html(resp)
          if ($size != '') {
            $('#uni_modal .modal-dialog').addClass($size)
          } else {
            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
          }
          $('#uni_modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false,
            focus: true
          })
          end_load()
        }
      }
    })
  }

  // функция для взятия времени и даты
  $('.datetimepicker').datetimepicker({
    format: 'Y/m/d H:i',
    startDate: '+3d'
  })

  // функция для выбора ??
  $('.select2').select2({
    placeholder: "Please select here",
    width: "100%"
  })
  // функция для замены цифр
  $('.number').on('input', function () {
    var val = $(this).val()
    val = val.replace(/[^0-9 \,]/, '');
    $(this).val(val)
  })
</script>