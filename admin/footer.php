<div class="row-fluid">
					<div id="footer" class="span12">
					2013 &copy;  FDC Admin.</div>
				</div>
                
                
            <script src="js/excanvas.min.js"></script>
            <script src="../js/utils.js"></script>
            <script src="js/jquery.min.js"></script>
            <script src="js/jquery.ui.custom.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.flot.min.js"></script>
            <script src="js/jquery.flot.resize.min.js"></script>
            <script src="js/jquery.peity.min.js"></script>
            <script src="js/fullcalendar.min.js"></script>
            <script src="js/unicorn.js"></script>
            <script src="js/unicorn.dashboard.js"></script>
            
            
            <script src="js/jquery.min.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/jquery.scrollUp.js"></script>
			<script src="js/jquery.dataTables.js"></script>
                        <script src="js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'Scroll to top', // Text for element
          activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });

      //Tooltip
      $('a').tooltip('hide');

      //Data Tables
      $(document).ready(function () {
        $('#data-table').dataTable({
          "sPaginationType": "full_numbers"
        });
      });

      jQuery('.delete-row').click(function () {
        var conf = confirm('Continue delete?');
        if (conf) jQuery(this).parents('tr').fadeOut(function () {
          jQuery(this).remove();
        });
          return false;
        });
      </script>