<?php
    $db2 = new Database();
    new Constants();
    $activeSponsors = $db2->getWhere(SPONSORS, array(ACTIVATION_STATUS=>1));
?>

<div id="headlines">
<div class="main">


<div id="newsticker-demo">    
    <div class="newsticker-jcarousellite" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; width: 939px;">
		<ul style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; width: 2191px; left: -1020.8246540193713px;">
                    
                    <?php foreach($activeSponsors as $sp) {?>
                        <li style="overflow: hidden; float: left; width: 280px; height: 85px;">
                            <div class="panel">
                                <div class="logo">
                                    <img src="images/uploads/sponsors/<?php echo $sp[SPONSOR_LOGO]; ?>" alt="logo">
                                    </div>
                                    <div class="blurb">
                                   <?php echo $sp[SPONSOR_NAME]; ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    
                    
                    
                    </ul>
    </div>
    
</div>


        
    </div>
</div>


<div id="footer">
	<div class="content">
    	<div class="copyright">
        	Copyright 2013 FDC. All rights reserved.
        </div>
        <div class="socialmedia">
                        <a href="http://www.facebook.com/FDC" target="_blank" title="Like us on Facebook"><img src="images/icons/facebook_64.png" alt="FDC - Facebook" /></a>
                        <a href="http://www.twitter.com/FDC" target="_blank" title="Follow us on twitter"><img src="images/icons/twitter_64.png" alt="FDC - Twitter" /></a>
                              </div>
    </div>
</div>

  

</div> <!-- /container -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jquery.rating.pack.js"></script>
<script src="js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$(".newsticker-jcarousellite").jCarouselLite({
		vertical: false,
		hoverPause:true,
		visible: 3,
		auto:1200,
		speed:1200
	});
});
</script>