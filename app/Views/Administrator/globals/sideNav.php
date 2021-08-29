<div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="md" data-toggle-body="true">
    <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
    <div class="nk-sidebar-menu" data-simplebar>
        <ul class="nk-menu nk-menu-main">

            <!-- MAIN MENU START -->
            <?php echo view('Administrator/globals/mainMenu'); ?>
            <!-- MAIN MENU END -->

        </ul><!-- .nk-menu -->
        <ul class="nk-menu d-md-none d-lg-block">
            <?php if ($uriSegments[2] == 'services' || $uriSegments[2] == 'service') : ?>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Services</h6>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/services" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-grid-alt"></em></span>
                        <span class="nk-menu-text">All Services</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="/administrator/service/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-grid-add-c"></em></span>
                        <span class="nk-menu-text">Add Service</span>
                    </a>
                </li>   

                <li class="nk-menu-item">
                    <a href="/administrator/service/forms" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-notes-alt"></em></span>
                        <span class="nk-menu-text">Service Forms</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="/administrator/service/forms/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-note-add"></em></span>
                        <span class="nk-menu-text">Add Service Form</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/service/documents" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-todo-fill"></em></span>
                        <span class="nk-menu-text">Document Blocks</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="/administrator/service/documents/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-note-add-fill-c"></em></span>
                        <span class="nk-menu-text">Add Document Block</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/service/faqs" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-property-alt"></em></span>
                        <span class="nk-menu-text">FAQ Blocks</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="/administrator/service/faqs/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-property-add"></em></span>
                        <span class="nk-menu-text">Add FAQ Block</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/service/packages" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-file"></em></span>
                        <span class="nk-menu-text">Service Packages</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="/administrator/service/packages/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-file-plus"></em></span>
                        <span class="nk-menu-text">Add Service Package</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/services/queries" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-emails"></em></span>
                        <span class="nk-menu-text">Service Queries</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/services/testimonials" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-comments"></em></span>
                        <span class="nk-menu-text">Service Testimonials</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($uriSegments[2] == 'blogs' || $uriSegments[2] == 'blog') : ?>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Blogs</h6>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/blogs" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                        <span class="nk-menu-text">All Blogs</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/blog/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Add Blog</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/blog/categories" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Categories</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/blog/comments" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Comments</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($uriSegments[2] == 'projects' || $uriSegments[2] == 'project') : ?>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Projects</h6>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/projects" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                        <span class="nk-menu-text">All Projects</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/project/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Add Project</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/project/categories" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Categories</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($uriSegments[2] == 'teams' || $uriSegments[2] == 'team') : ?>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Team</h6>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/team" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                        <span class="nk-menu-text">Team Members</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/team/add" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Add Team Member</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($uriSegments[2] == 'other') : ?>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Others</h6>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/other/testimonials" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                        <span class="nk-menu-text">Testimonials</span>
                    </a>
                </li>

                <li class="nk-menu-item">
                    <a href="/administrator/other/contact-submission" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                        <span class="nk-menu-text">Contact Submission</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>

    </div>

    <div class="nk-aside-close">
        <a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a>
    </div>
</div>