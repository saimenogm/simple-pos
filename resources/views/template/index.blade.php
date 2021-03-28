<!DOCTYPE html>
<html lang="en">
    <head>                        
        <title>Inventory Management System</title>            
        
        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>        
        
        <!-- APP WRAPPER -->
        <div class="app">           

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->
                <div class="app-sidebar app-navigation app-navigation-style-default app-navigation-open-hover dir-left" data-type="close-other">
                    <a href="index.html" class="app-navigation-logo">
                    Inventory Management System
                        <button class="app-navigation-logo-button mobile-hidden" data-sidepanel-toggle=".app-sidepanel"><span class="icon-alarm"></span> <span class="app-navigation-logo-button-alert">7</span></button>
                    </a>
                    <nav>
                        <ul>
                            <li class="title">MAIN</li>
                            <li><a href="index.html"><span class="icon-laptop-phone"></span> Dashboard</a></li>
                            <li>
                                <a href="#"><span class="icon-files"></span> Pages</a>
                                <ul>                                
                                    <li><a href="pages-faq.html"><span class="icon-question-circle"></span> FAQ</a></li>
                                    <li><a href="pages-gallery.html"><span class="icon-picture3"></span> Gallery</a></li>
                                    <li><a href="pages-help.html"><span class="icon-lifebuoy"></span> Help</a></li>
                                    <li><a href="pages-search.html"><span class="icon-earth"></span> Search Result</a></li>
                                    <li>
                                        <a href="#"><span class="icon-bag-dollar"></span> Bank Application</a>
                                        <ul>                
                                            <li><a href="pages-bank-main.html"><span class="icon-coin-dollar"></span> Main</a></li>
                                            <li><a href="pages-bank-deposits.html"><span class="icon-cash-dollar"></span> Deposits</a></li>
                                            <li><a href="pages-bank-activity.html"><span class="icon-sync"></span> Activity</a></li>
                                            <li><a href="pages-bank-settings.html"><span class="icon-cog"></span> Settings</a></li>
                                            <li><a href="pages-bank-security.html"><span class="icon-shield-check"></span> Security</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-document2"></span> Blog Pages</a>
                                        <ul>                
                                            <li><a href="pages-blog-main.html"><span class="icon-document"></span> Main (Variant 1)</a></li>
                                            <li><a href="pages-blog-main-2.html"><span class="icon-document"></span> Main (Variant 2)</a></li>
                                            <li><a href="pages-blog-category.html"><span class="icon-papers"></span> Category (Right Sidebar)</a></li>
                                            <li><a href="pages-blog-category-2.html"><span class="icon-papers"></span> Category (Left Sidebar)</a></li>
                                            <li><a href="pages-blog-single.html"><span class="icon-document2"></span> Single</a></li>                        
                                        </ul>
                                    </li>
                                    <li><a href="pages-contact-list.html"><span class="icon-group-work"></span> Contact List</a></li>
                                    <li>
                                        <a href="#"><span class="icon-bubble"></span> Messages</a>
                                        <ul>
                                            <li><a href="pages-messages-chat.html"><span class="icon-bubble-dots"></span> Chat</a></li>
                                            <li><a href="pages-messages-list.html"><span class="icon-bubble-user"></span> Messages List</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="pages-lock-screen.html"><span class="icon-lock"></span> Lock Screen</a></li>
                                    <li>
                                        <a href="#"><span class="icon-enter-right"></span> Log In / Sign In</a>
                                        <ul>
                                            <li><a href="pages-login.html"><span class="icon-cli"></span> Log In</a></li>
                                            <li><a href="pages-login-bg.html"><span class="icon-picture3"></span> Log In (Background)</a></li>
                                            <li><a href="pages-signin.html"><span class="icon-user-plus"></span> Sign In</a></li>
                                            <li><a href="pages-signin-bg.html"><span class="icon-calendar-user"></span> Sign In (Background)</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>                
                            <li><a href="documentation.html"><span class="icon-lifebuoy"></span> Documentation</a></li>
                            
                            <li class="title">LAYOUTS</li>                
                            <li>
                                <a href="#"><span class="icon-icons2"></span> Layout Components</a>
                                <ul>
                                    <li>
                                        <a href="#"><span class="icon-border-top"></span> Headers</a>
                                        <ul>                
                                            <li><a href="layouts-header.html"><span class="icon-arrow-up-square"></span> Simple</a></li>
                                            <li><a href="layouts-header-inside.html"><span class="icon-minus-square"></span> Insde Content</a></li>
                                            <li><a href="layouts-header-title.html"><span class="icon-document"></span> With Title</a></li>
                                            <li><a href="layouts-header-navigation.html"><span class="icon-window"></span> Simple Navigation</a></li>
                                            <li><a href="layouts-header-navigation-custom.html"><span class="icon-window"></span> Simple Navigation (Hover Item)</a></li>
                                            <li><a href="layouts-header-navigation-extended.html"><span class="icon-menu"></span> Extended Navigation</a></li>
                                        </ul>
                                    </li>
                                    <li>                                                                
                                        <a href="#"><span class="icon-indent-increase"></span> Sidebars</a>
                                        <ul>
                                            <li><a href="layouts-sidebar-left.html"><span class="icon-chevron-left-square"></span> Left Sidebar</a></li>
                                            <li><a href="layouts-sidebar-right.html"><span class="icon-chevron-right-square"></span> Right Sidebar</a></li>
                                            <li><a href="layouts-sidebar-left-right.html"><span class="icon-menu-square"></span> Left & Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>                                                                
                                        <a href="#"><span class="icon-menu"></span> Navigation</a>
                                        <ul>
                                            <li><a href="layouts-navigation-default.html"><span class="icon-menu-square"></span> Default</a></li>
                                            <li><a href="layouts-navigation-default-fixed.html"><span class="icon-border-style"></span> Default Fixed</a></li>
                                            <li><a href="layouts-navigation-close-other.html"><span class="icon-chevron-down-square"></span> Close Other</a></li>
                                            <li><a href="layouts-navigation-hidden.html"><span class="icon-border-none"></span> Hidden</a></li>
                                            <li><a href="layouts-navigation-minimized.html"><span class="icon-enter-left2"></span> Minimized</a></li>
                                            <li><a href="layouts-navigation-open-hover.html"><span class="icon-fingers-scroll-vertical"></span> Open On Hover</a></li>
                                            <li><a href="layouts-navigation-light.html"><span class="icon-drop2"></span> Custom Theme</a></li>
                                            <li><a href="layouts-navigation-mobile.html"><span class="icon-smartphone"></span> Mobile Style (Simple)</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-menu-square"></span> Content</a>
                                        <ul>
                                            <li><a href="layouts-content-resizable.html"><span class="icon-fingers-scroll-horizontal"></span> Resizable</a></li>
                                            <li><a href="layouts-content-tabbed.html"><span class="icon-new-tab"></span> Tabbed Content</a></li>
                                            <li><a href="layouts-content-tabbed-controls.html"><span class="icon-new-tab"></span> Tabbed Content (Controls)</a></li>                
                                            <li><a href="layouts-content-separated.html"><span class="icon-border-vertical"></span> Separated Content</a></li>                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-text-wrap"></span> Sidepanels</a>
                                        <ul>
                                            <li><a href="layouts-sidepanel.html"><span class="icon-border-right"></span> Default</a></li>
                                            <li><a href="layouts-sidepanel-overlay.html"><span class="icon-gradient"></span> With Overlay</a></li>
                                        </ul>
                                    </li>  
                                    <li>
                                        <a href="#"><span class="icon-page-break2"></span> Footers</a>
                                        <ul>
                                            <li><a href="layouts-footer-default.html"><span class="icon-border-bottom"></span> Simple</a></li>
                                            <li><a href="layouts-footer-extended.html"><span class="icon-icons2"></span> Extended</a></li>
                                            <li><a href="layouts-footer-custom.html"><span class="icon-drop2"></span> Custom Design</a></li>                
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-transform"></span> Layout Options</a>            
                                <ul>
                                    <li>
                                        <a href="#"><span class="icon-document"></span> Left Navigation</a>                                        
                                        <ul>
                                            <li><a href="layouts-option-basic.html"><span class="icon-document2"></span> Basic</a></li>
                                            <li><a href="layouts-option-basic-header.html"><span class="icon-register"></span> With Header</a></li>
                                            <li><a href="layouts-option-basic-footer.html"><span class="icon-page-break2"></span> With Footer</a></li>
                                            <li><a href="layouts-option-basic-header-footer.html"><span class="icon-document"></span> Header & Footer</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-document"></span> Top Navigation</a>
                                        <ul>
                                            <li><a href="layouts-option-topnav-header.html"><span class="icon-arrow-right-square"></span> Header Navigation</a></li>
                                            <li><a href="layouts-option-topnav-horizontal.html"><span class="icon-check-square"></span> Horizontal Navigation</a></li>
                                            <li><a href="layouts-option-topnav-horizontal-boxed.html"><span class="icon-menu-square"></span> Horizontal Navigation (Boxed)</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-square"></span> Boxed</a>                                        
                                        <ul>
                                            <li><a href="layouts-option-boxed.html"><span class="icon-menu-square"></span> Basic</a></li>
                                            <li><a href="layouts-option-boxed-custom.html"><span class="icon-arrow-down-square"></span> With Margin</a></li>
                                            <li><a href="layouts-option-boxed-content.html"><span class="icon-minus-square"></span> Boxed Content</a></li>
                                        </ul>
                                    </li>
                                </ul>                        
                            </li>
                            
                            <li class="title">COMPONENTS</li>
                            <li>
                                <a href="#"><span class="icon-layers"></span> UI Elements</a>
                                <ul>                                
                                    <li><a href="components-blocks-panels.html"><span class="icon-window"></span> Blocks & Panles</a></li>
                                    <li><a href="components-tabs-accordion.html"><span class="icon-select2"></span> Tabs & Accordions</a></li>
                                    <li><a href="components-alerts-notifications.html"><span class="icon-warning"></span> Alerts & Notifications</a></li>
                                    <li><a href="components-modals-popups.html"><span class="icon-new-tab"></span> Modals & Popups</a></li>
                                    <li><a href="components-dropdowns.html"><span class="icon-menu3"></span> Dropdowns</a></li>
                                    <li><a href="components-buttons.html"><span class="icon-radio-button"></span> Buttons</a></li>                
                                    <li><a href="components-progressbar.html"><span class="icon-align-center-vertical"></span> Progress Bars</a></li>                                
                                    <li><a href="components-pagination.html"><span class="icon-arrow-right-circle"></span> Pagination</a></li>                                
                                    <li><a href="components-spinners.html"><span class="icon-loading"></span> Spinners</a></li>
                                    <li><a href="components-help-classes.html"><span class="icon-lifebuoy"></span> Help Classes</a></li>
                                    <li><a href="components-widgets.html"><span class="icon-pictures"></span> Widgets & Informers</a></li>
                                    <li>
                                        <a href="#"><span class="icon-menu2"></span> Lists</a>
                                        <ul>                
                                            <li><a href="components-lists.html"><span class="icon-list"></span> Basic Lists</a></li>
                                            <li><a href="components-user-contacts.html"><span class="icon-users2"></span> User & Contacts</a></li>
                                            <li><a href="components-tiles.html"><span class="icon-portrait2"></span> Tiles</a></li>
                                            <li><a href="components-news-info.html"><span class="icon-profile"></span> News & Info</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-text-format"></span> Typography</a>
                                        <ul>
                                            <li><a href="components-typography.html"><span class="icon-text-size"></span> Typography</a></li>
                                            <li><a href="components-labels-badges.html"><span class="icon-bookmark2"></span> Labels & Badges</a></li>
                                            <li><a href="components-text-heading.html"><span class="icon-clipboard-text"></span> Text Heading</a></li>
                                            <li><a href="components-heading.html"><span class="icon-menu-square"></span> Page & Block Heading</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-star"></span> Features</a>
                                <ul>                
                                    <li><a href="components-features-gallery.html"><span class="icon-pictures"></span> Compact Gallery</a></li>
                                    <li><a href="components-features-tips.html"><span class="icon-bullhorn"></span> Tips</a></li>
                                    <li><a href="components-features-loading.html"><span class="icon-ellipsis"></span> Loading</a></li>
                                    <li><a href="components-features-statusbar.html"><span class="icon-warning"></span> Status Bar</a></li>
                                    <li><a href="components-features-preview.html"><span class="icon-eye"></span> Preview</a></li>
                                </ul>
                            </li>        
                            <li>
                                <a href="#"><span class="icon-power"></span> Icons</a>
                                <ul>
                                    <li><a href="components-icons-linearicons.html"><span class="icon-diamond2"></span> Linearicons</a></li>
                                    <li><a href="components-icons-fontawesome.html"><span class="icon-leaf"></span> Font Awesome</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-grid"></span> Tables</a>
                                <ul>
                                    <li><a href="components-tables-default.html"><span class="icon-text-align-justify"></span> Default</a></li>
                                    <li><a href="components-tables-sortable.html"><span class="icon-sort-alpha-asc"></span> Sortable</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-chart-growth"></span> Charts</a>
                                <ul>                                
                                    <li><a href="components-charts-morris.html"><span class="icon-graph"></span> Morris Charts</a></li>
                                    <li><a href="components-charts-rickshaw.html"><span class="icon-chart-growth"></span> Rickshaw Charts</a></li>
                                    <li><a href="components-charts-other.html"><span class="icon-signal"></span> Other</a></li>                
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-map"></span> Maps</a>
                                <ul>
                                    <li><a href="components-maps-jvectormap.html"><span class="icon-map-marker"></span> jVectorMap</a></li>
                                    <li><a href="components-maps-google.html"><span class="icon-map-marker-check"></span> Google Maps</a></li>
                                </ul>
                            </li>
                            
                            <li class="title">FORMS</li>
                            <li>
                                <a href="#"><span class="icon-pencil"></span> Form Elements</a>
                                <ul>
                                    <li><a href="forms-elements-basic.html"><span class="icon-menu2"></span> Basic Elements</a></li>
                                    <li><a href="forms-elements-checkbox-radio.html"><span class="icon-check-square"></span> Checkbox, Radio & Switch</a></li>
                                    <li><a href="forms-elements-select-datepicker.html"><span class="icon-calendar-insert"></span> Select & Datepicker</a></li>
                                    <li><a href="forms-elements-valudation-states.html"><span class="icon-clipboard-check"></span> Validation States</a></li>
                                    <li><a href="forms-elements-input-groups.html"><span class="icon-list4"></span> Input Group</a></li>
                                    <li><a href="forms-elements-other.html"><span class="icon-chip"></span> Other</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-shield-check"></span> Validation</a>
                                <ul>
                                    <li><a href="forms-valudation-engine.html"><span class="icon-shield-cross"></span> Validation Engine</a></li>
                                    <li><a href="forms-valudation-helpers.html"><span class="icon-cli"></span> Masked Helpers</a></li>                                                    
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="icon-folder-star"></span> Miscellaneous</a>
                                 <ul>
                                    <li><a href="forms-wysiwyg-editors.html"><span class="icon-pencil4"></span> WYSIWYG Editors</a></li>
                                    <li><a href="forms-code-preview.html"><span class="icon-code"></span> Code Preview</a></li>
                                </ul>
                            </li>
                            <li class="title">RTL</li>
                            <li><a href="rtl.html"><span class="icon-arrow-left"></span> RTL Support</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- END SIDEBAR -->
                
                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <!-- START APP HEADER -->
                    <div class="app-header">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-list4"></span></a></li>
                        </ul>
                        <form class="app-header-search" action="" method="post">        
                            <input type="text" name="keyword" placeholder="Search">
                        </form>    
                    
                        <ul class="app-header-buttons pull-right">
                            <li>
                                <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls">
                                    <img src="{{ asset('images/users/user_1.jpg')}}" alt="John Doe">
                                    <div class="contact-container">
                                        <a href="#">John Doe</a>
                                        <span>Administrator</span>
                                    </div>
                                    <div class="contact-controls">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span class="icon-cog"></span></button>                        
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-cog"></span> Settings</a></li> 
                                                <li><a href="#"><span class="icon-envelope"></span> Messages <span class="label label-danger pull-right">+24</span></a></li>
                                                <li><a href="#"><span class="icon-users"></span> Contacts <span class="label label-default pull-right">76</span></a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><span class="icon-exit-right"></span> Log Out</a></li> 
                                            </ul>
                                        </div>                    
                                    </div>
                                </div>
                            </li>        
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->
                    
                    <!-- START PAGE HEADING -->
                   
                    <!-- END PAGE HEADING -->
                    
                    <!-- START PAGE CONTAINER -->
                    <div class="container">
                                                
                            
                        
                        
                    </div>
                    <!-- END PAGE CONTAINER -->
                    
                </div>
                <!-- END APP CONTENT -->
                                
            </div>
            <!-- END APP CONTAINER -->
                        
            <!-- START APP FOOTER -->
            <div class="app-footer app-footer-default" id="footer">
            
                <div class="alert alert-primary alert-dismissible alert-inside text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="icon-cross"></span></button>
                    We use cookies to offer you the best experience on our website. Continuing browsing, you accept our cookies policy.
                </div>
            
                <div class="app-footer-line extended">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <h3 class="title"><img src="/img/logo-footer.png" alt="boooyah"> Boooya</h3>                            
                            <p>The innovation in admin template design. You will save hundred hours while working with our template. That is based on latest technologies and understandable for all.</p>
                            <p><strong>How?</strong><br>This template included with thousand of best components, that really help you to build awesome design.</p>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <h3 class="title"><span class="icon-clipboard-text"></span> About Us</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">About</a></li>                                                                
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Why use us?</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4">                            
                            <h3 class="title"><span class="icon-lifebuoy"></span> Need Help?</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">FAQ</a></li>                                                                
                                <li><a href="#">Community</a></li>
                                <li><a href="#">Contacts</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-6 clear-mobile">
                            <h3 class="title"><span class="icon-reading"></span> Latest News</h3>
            
                            <div class="row app-footer-articles">
                                <div class="col-md-3 col-sm-4">
                                    <img src="/{{ asset('images/preview/img-1.jpg')}}" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <a href="#">Best way to increase vocabulary</a>
                                    <p>Quod quam magnum sit fictae veterum fabulae declarant, in quibus tam multis.</p>
                                </div>
                            </div>
            
                            <div class="row app-footer-articles">
                                <div class="col-md-3 col-sm-4">
                                    <img src="/{{ asset('images/preview/img-2.jpg')}} ')}}'" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <a href="#">Best way to increase vocabulary</a>
                                    <p>In quibus tam multis tamque variis ab ultima antiquitate repetitis tria.</p>
                                </div>
                            </div>
            
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <h3 class="title"><span class="icon-thumbs-up"></span> Social Media</h3>
            
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-youtube"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-feed"></i>
                            </a>
            
                            <h3 class="title"><span class="icon-paper-plane"></span> Subscribe</h3>
            
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="E-mail...">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary">GO</button>
                                </div>
                            </div> 
                        </div>                        
                    </div>                    
                </div>
                <div class="app-footer-line darken">                
                    <div class="copyright wide text-center">&copy; 2016 Boooya. All right reserved in the Ukraine and other countries.</div>                
                </div>
            </div>
            <!-- END APP FOOTER -->

            <!-- START APP SIDEPANEL -->
            <div class="app-sidepanel scroll" data-overlay="show">                
                <div class="container">
                    
                    <div class="app-heading app-heading-condensed app-heading-small">
                        <div class="icon icon-lg">
                            <span class="icon-alarm"></span>
                        </div>
                        <div class="title">
                            <h2>Notifications</h2>              
                            <p><strong>7 new</strong>, latest: July 19, 2016 at 10:14:32.</p>
                        </div>                                
                    </div>        
            
                    <div class="listing margin-bottom-10">                                                                                
                        <div class="listing-item margin-bottom-10">
                            <strong>Product Delivered</strong> <span class="label label-success pull-right">delivered</span>
                            <p class="margin-0 margin-top-5">#SPW-955-18 to st. StreetName SA, USA.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 19/07/2016 10:14:32 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Successful Payment</strong> <span class="label label-success pull-right">success</span>
                            <p class="margin-0 margin-top-5">Payment for order #SPW-955-17: <strong>$145.44</strong>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 09:55:12 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>New Order #SPW-955-17</strong> <span class="label label-warning pull-right">waiting</span>
                            <p class="margin-0 margin-top-5">Added new order, waiting for payment. <a href="#">Order details</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 09:51:55 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Money Back Request</strong> <span class="label label-primary pull-right">return</span>
                            <p class="margin-0 margin-top-5">#SPW-955-17 return requested. <a href="#">Request details</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 08:44:51 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>The critical amount of product</strong> <span class="label label-danger pull-right">important</span>
                            <p class="margin-0 margin-top-5">Product: <a href="#">Extra Awesome Product</a> (amount: <span class="text-danger">2</span>). <a href="#">Storehouse</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-cube margin-right-5"></span> 19/07/2016 08:30:00 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Product Delivery Start</strong> <span class="label label-warning pull-right">delivering</span>
                            <p class="margin-0 margin-top-5">#SPW-955-18 to st. StreetName SA, USA.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 18/07/2016 06:14:32 PM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Critical Server Load</strong> <span class="label label-danger pull-right">server</span>
                            <p class="margin-0 margin-top-5">Disk space: 248.1Gb/250Gb. <a href="#">Control panel</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 18/07/2016 06:14:32 PM
                            </p>
                        </div>
                    </div>
                    <div class="row margin-bottom-30">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button class="btn btn-default btn-block">All Notification</button>
                        </div>            
                    </div>
                    
                    <div class="app-heading app-heading-condensed app-heading-small margin-bottom-20">
                        <div class="icon icon-lg">
                            <span class="icon-cog"></span>
                        </div>
                        <div class="title">
                            <h2>Settings</h2>              
                            <p>Notification Settings</p>
                        </div>                                
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_1" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Delivery Information</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_2" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Product Amount Information</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_3" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Order Information</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_4" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Server Load</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_5" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>User Registrations</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_6" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Purchase Information</label>
                            </div>
                        </div>            
                    </div>
                    
                </div>
            </div>
            <!-- END APP SIDEPANEL -->


            <div class="row">
                            <div class="col-md-6">
                                
                                <div class="block block-condensed">
                                    <!-- START HEADING -->
                                    <div class="app-heading app-heading-small">
                                        <div class="title">
                                            <h5>Basic Table</h5>
                                            <p>Add class <code>table</code> to <code>&lt;table></code> to get basic table.</p>
                                        </div>
                                    </div>
                                    <!-- END HEADING -->

                                    <div class="block-content">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>2016</th>
                                                    <th>Chrome</th>
                                                    <th>IE</th>
                                                    <th>Firefox</th>
                                                    <th>Safari</th>
                                                    <th>Opera</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>April</td>
                                                    <td>70.4 %</td>
                                                    <td>5.8 %</td>
                                                    <td>17.5 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>March</td>
                                                    <td>69.9 %</td>
                                                    <td>6.1 %</td>
                                                    <td>17.8 %</td>
                                                    <td>3.6 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>February</td>
                                                    <td>69.0 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.6 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>January</td>
                                                    <td>68.4 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.8 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.4 %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                            
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                
                                <div class="block block-condensed">
                                    <!-- START HEADING -->
                                    <div class="app-heading app-heading-small">
                                        <div class="title">
                                            <h5>Striped Rows</h5>
                                            <p>Add class <code>table-striped</code> to get stripped rows insed table body.</p>
                                        </div>
                                    </div>
                                    <!-- END HEADING -->

                                    <div class="block-content">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>2016</th>
                                                    <th>Chrome</th>
                                                    <th>IE</th>
                                                    <th>Firefox</th>
                                                    <th>Safari</th>
                                                    <th>Opera</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>April</td>
                                                    <td>70.4 %</td>
                                                    <td>5.8 %</td>
                                                    <td>17.5 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>March</td>
                                                    <td>69.9 %</td>
                                                    <td>6.1 %</td>
                                                    <td>17.8 %</td>
                                                    <td>3.6 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>February</td>
                                                    <td>69.0 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.6 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>January</td>
                                                    <td>68.4 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.8 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.4 %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                            
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="block block-condensed">
                                    <!-- START HEADING -->
                                    <div class="app-heading app-heading-small">
                                        <div class="title">
                                            <h5>Table Bordered</h5>
                                            <p>Add class <code>table-bordered</code> to get bordered table style.</p>
                                        </div>
                                    </div>
                                    <!-- END HEADING -->

                                    <div class="block-content">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>2016</th>
                                                    <th>Chrome</th>
                                                    <th>IE</th>
                                                    <th>Firefox</th>
                                                    <th>Safari</th>
                                                    <th>Opera</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>April</td>
                                                    <td>70.4 %</td>
                                                    <td>5.8 %</td>
                                                    <td>17.5 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>March</td>
                                                    <td>69.9 %</td>
                                                    <td>6.1 %</td>
                                                    <td>17.8 %</td>
                                                    <td>3.6 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>February</td>
                                                    <td>69.0 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.6 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>January</td>
                                                    <td>68.4 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.8 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.4 %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                            
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                
                                <div class="block block-condensed">
                                    <!-- START HEADING -->
                                    <div class="app-heading app-heading-small">
                                        <div class="title">
                                            <h5>Table Hover</h5>
                                            <p>Add class <code>table-hover</code> to get background on hover.</p>
                                        </div>
                                    </div>
                                    <!-- END HEADING -->

                                    <div class="block-content">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>2016</th>
                                                    <th>Chrome</th>
                                                    <th>IE</th>
                                                    <th>Firefox</th>
                                                    <th>Safari</th>
                                                    <th>Opera</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>April</td>
                                                    <td>70.4 %</td>
                                                    <td>5.8 %</td>
                                                    <td>17.5 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>March</td>
                                                    <td>69.9 %</td>
                                                    <td>6.1 %</td>
                                                    <td>17.8 %</td>
                                                    <td>3.6 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>February</td>
                                                    <td>69.0 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.6 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.3 %</td>
                                                </tr>
                                                <tr>
                                                    <td>January</td>
                                                    <td>68.4 %</td>
                                                    <td>6.2 %</td>
                                                    <td>18.8 %</td>
                                                    <td>3.7 %</td>
                                                    <td>1.4 %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                            
                                </div>
                                
                            </div>
                        </div>
                        

            
            <!-- APP OVERLAY -->
            <div class="app-overlay"></div>
            <!-- END APP OVERLAY -->
        </div>        
        <!-- END APP WRAPPER -->                
        
        <!-- START SCRIPTS -->
        <script type="text/javascript" src="{{ asset('js/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap1.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/moment/moment.min.js')}}"></script>       
        
        <script type="text/javascript" src="{{ asset('js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap-select.js)}}"><bootstrap-select1.jscript type="text/javascript" src="{{ asset('js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/maskedinput/jquery.maskedinput.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/form-validator/jquery.form-validator.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/noty/jquery.noty.packaged.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/sweetalert/sweetalert.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/knob/jquery.knob.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/jvectormap/jquery-jvectormap.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/sparkline/jquery.sparkline.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/morris/raphael.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/morris/morris.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/rickshaw/d3.v3.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor/rickshaw/rickshaw.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/vendor/isotope/isotope.pkgd.min.js')}}"></script>
        
        <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/app_plugins.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/app_demo.js')}}"></script>
        <!-- END SCRIPTS -->
        <script type="text/javascript" src="{{ asset('js/app_demo_dashboard.js')}}"></script>
    </body>
</html>