<!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      $(document).ready(function () {


        $(".app-menu__item").each(function () {
            if (this.href == window.location.href) {
                $(this).addClass("active");
            }
        });

    });

      function deleteData(id,url){
        $.ajax({
          type: 'POST',
          url: url+'.php',
          data: 'action_type=delete&id='+id,
          success:function(html){
            location.reload();
          }
        });
        
      }
    </script>
  </body>
</html>