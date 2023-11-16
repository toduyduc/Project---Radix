<!-- Breadcrumbs -->
<section class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($data['breadCrumbName'])): ?>
                <h2><i class="fa fa-pencil"></i><?php echo (!empty($data['breadCrumbName']))?$data['breadCrumbName']:false; ?></h2>
                <?php else: ?>
                <h2><i class="fa fa-pencil"></i><?php echo (!empty($data['pageTitle']))?$data['pageTitle']:false; ?></h2>
                <?php endif; ?>
                <ul>
                    <li><a href="<?php echo _WEB_HOST_ROOT; ?>"><i class="fa fa-home"></i>Trang chủ</a></li>
                    <?php echo (!empty($data['itemParent']))?$data['itemParent']:false; ?>
                    <li class="active"><a href="#"><i class="fa fa-clone"></i><?php echo (!empty($data['pageTitle']))?$data['pageTitle']:false; ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--/ End Breadcrumbs -->