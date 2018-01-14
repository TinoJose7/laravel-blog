<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="header">MAIN NAVIGATION</li>

            <li class="{{ (Request::route()->getName() == 'home')? 'active':'' }}">
                <a href="/home">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{( (Request::is('categories') ||
                Request::is('categories/*') ||
                Request::is('posts') || Request::is('posts/*')) )? 'active':''}}">
                <a href="#">
                    <i class="fa fa-pencil-square-o"></i> <span>Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ( (Request::is('categories') || Request::is('categories/*')) )? 'start active':''}}">
                        <a href="/categories"><i class="fa fa-tags"></i> Category</a>
                    </li>
                    <li class="{{ ( (Request::is('posts') || Request::is('posts/*')) )? 'start active':''}}">
                        <a href="/posts"><i class="fa fa-newspaper-o "></i> Posts</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
