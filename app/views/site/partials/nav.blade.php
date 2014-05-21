<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">{{ HTML::image('images/Logo.jpg' ,'logo', array('class'=>'img-responsive')) }}</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li><a href="/">الرئيسية</a></li>
            <li><a href="/courses">الدورات</a></li>
            <li><a href="{{ action('GalleriesController@index') }}">معرض الدورات</a></li>
            <li><a href="/news">الأخبار</a></li>
            <li><a href="#">من نحن</a></li>
            <li><a href="#">اتصل بنا</a></li>
            <li><a class="ads" href="#">اتصل بنا</a></li>
        </ul>
    </div>
</div>