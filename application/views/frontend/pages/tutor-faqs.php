<main>
  <div class="container"> 
    <!-- Teachers profile
======================================== -->
    <section>
      <div class="row">
        <div class="col-md-12">
	  <h2>Tutor FAQs</h2>
      </div>
	  <?php if(!empty($page_faqs)){
			foreach ($page_faqs as $key=>$page_faq){
				if(!empty($page_faq['faqs'])){?>
        <div class="col-md-6">
			<h4><?php echo $page_faq['heading'] ?></h4>
          <div class="panel-group margin-0" id="accordion<?php echo $key ?>" role="tablist" aria-multiselectable="true">
		  <?php foreach ($page_faq['faqs'] as $key1=>$faq){ ?>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="heading<?php echo $faq['faq_id'] ?>">
                <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $key ?>" href="#collapse<?php echo $faq['faq_id'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $faq['faq_id'] ?>" class=""><?php echo $faq['question'] ?></a> </h4>
              </div>
              <div id="collapse<?php echo $faq['faq_id'] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $faq['faq_id'] ?>" aria-expanded="true">
                <div class="panel-body">
				  <p><?php echo $faq['answer'] ?></p>
                </div>
              </div>
			</div>
		  <?php } ?>
          </div>
        </div>
				<?php	}
			}
	  } else { ?>
        <div class="col-md-12">
	  <h5>Sorry, no content available for this page</h5>
      </div>
	  <?php } ?>
      </div>
	  
<!-- margin-30-0 -->	  
    </section>
    <!-- teacher profile end --> 
  </div>
</main>
