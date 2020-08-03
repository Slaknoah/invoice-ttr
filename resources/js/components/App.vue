<template>
    <transition name="load" mode="out-in">
        <div class="logged-view" key="logged-in" v-if="isLoggedIn">
            <the-header></the-header>

            <the-navigation></the-navigation>
            <div id="main">
                <div class="row">
                    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
                    <base-breadcrumb></base-breadcrumb>
                    <div class="col s12">
                        <div class="container">
                            <router-view></router-view>
                            <!-- START RIGHT SIDEBAR NAV -->
                            <aside id="right-sidebar-nav">
    <!--                            <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">-->
    <!--                                <div class="row">-->
    <!--                                    <div class="slide-out-right-title">-->
    <!--                                        <div class="col s12 border-bottom-1 pb-0 pt-1">-->
    <!--                                            <div class="row">-->
    <!--                                                <div class="col s2 pr-0 center">-->
    <!--                                                    <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>-->
    <!--                                                </div>-->
    <!--                                                <div class="col s10 pl-0">-->
    <!--                                                    <ul class="tabs">-->
    <!--                                                        <li class="tab col s4 p-0">-->
    <!--                                                            <a href="#messages" class="active">-->
    <!--                                                                <span>Messages</span>-->
    <!--                                                            </a>-->
    <!--                                                        </li>-->
    <!--                                                        <li class="tab col s4 p-0">-->
    <!--                                                            <a href="#settings">-->
    <!--                                                                <span>Settings</span>-->
    <!--                                                            </a>-->
    <!--                                                        </li>-->
    <!--                                                        <li class="tab col s4 p-0">-->
    <!--                                                            <a href="#activity">-->
    <!--                                                                <span>Activity</span>-->
    <!--                                                            </a>-->
    <!--                                                        </li>-->
    <!--                                                    </ul>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                    <div class="slide-out-right-body row pl-3">-->
    <!--                                        <div id="messages" class="col s12 pb-0">-->
    <!--                                            <div class="collection border-none mb-0">-->
    <!--                                                <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />-->
    <!--                                                <ul class="collection right-sidebar-chat p-0 mb-0">-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Elizabeth Elliott</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">5.00 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Mary Adams</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">4.14 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-2.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Caleb Richards</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">4.14 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-3.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Caleb Richards</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">9.00 PM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-4.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">June Lane</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">4.14 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-5.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Edward Fletcher</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">5.15 PM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-6.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Crystal Bates</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">8.00 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Nathan Watts</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">9.53 PM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-8.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Willard Wood</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">4.20 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Ronnie Ellis</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">5.20 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-9.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Daniel Russell</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">12.00 AM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-10.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Sarah Graves</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">11.14 PM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-11.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Andrew Hoffman</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">7.30 PM</span>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                                    <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-12.png" alt="avatar" />-->
    <!--                                                        <i></i>-->
    <!--                                                    </span>-->
    <!--                                                        <div class="user-content">-->
    <!--                                                            <h6 class="line-height-0">Camila Lynch</h6>-->
    <!--                                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>-->
    <!--                                                        </div>-->
    <!--                                                        <span class="secondary-content medium-small">2.00 PM</span>-->
    <!--                                                    </li>-->
    <!--                                                </ul>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div id="settings" class="col s12">-->
    <!--                                            <p class="setting-header mt-8 mb-3 ml-5 font-weight-900">GENERAL SETTINGS</p>-->
    <!--                                            <ul class="collection border-none">-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Notifications</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input checked type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Show recent activity</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Show recent activity</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Show Task statistics</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Show your emails</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Email Notifications</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input checked type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                            </ul>-->
    <!--                                            <p class="setting-header mt-7 mb-3 ml-5 font-weight-900">SYSTEM SETTINGS</p>-->
    <!--                                            <ul class="collection border-none">-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>System Logs</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Error Reporting</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Applications Logs</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input checked type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Backup Servers</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                                <li class="collection-item border-none">-->
    <!--                                                    <div class="m-0">-->
    <!--                                                        <span>Audit Logs</span>-->
    <!--                                                        <div class="switch right">-->
    <!--                                                            <label>-->
    <!--                                                                <input type="checkbox" />-->
    <!--                                                                <span class="lever"></span>-->
    <!--                                                            </label>-->
    <!--                                                        </div>-->
    <!--                                                    </div>-->
    <!--                                                </li>-->
    <!--                                            </ul>-->
    <!--                                        </div>-->
    <!--                                        <div id="activity" class="col s12">-->
    <!--                                            <div class="activity">-->
    <!--                                                <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>-->
    <!--                                                <ul class="widget-timeline mb-0">-->
    <!--                                                    <li class="timeline-items timeline-icon-green active">-->
    <!--                                                        <div class="timeline-time">Today</div>-->
    <!--                                                        <h6 class="timeline-title">Homepage mockup design</h6>-->
    <!--                                                        <p class="timeline-text">Melissa liked your activity.</p>-->
    <!--                                                        <div class="timeline-content orange-text">Important</div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-cyan active">-->
    <!--                                                        <div class="timeline-time">10 min</div>-->
    <!--                                                        <h6 class="timeline-title">Melissa liked your activity Drinks.</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content green-text">Resolved</div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-red active">-->
    <!--                                                        <div class="timeline-time">30 mins</div>-->
    <!--                                                        <h6 class="timeline-title">12 new users registered</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content">-->
    <!--                                                            <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Registration.doc-->
    <!--                                                        </div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-indigo active">-->
    <!--                                                        <div class="timeline-time">2 Hrs</div>-->
    <!--                                                        <h6 class="timeline-title">Tina is attending your activity</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content">-->
    <!--                                                            <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Activity.doc-->
    <!--                                                        </div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-orange">-->
    <!--                                                        <div class="timeline-time">5 hrs</div>-->
    <!--                                                        <h6 class="timeline-title">Josh is now following you</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content red-text">Pending</div>-->
    <!--                                                    </li>-->
    <!--                                                </ul>-->
    <!--                                                <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>-->
    <!--                                                <ul class="widget-timeline mb-0">-->
    <!--                                                    <li class="timeline-items timeline-icon-green active">-->
    <!--                                                        <div class="timeline-time">Just now</div>-->
    <!--                                                        <h6 class="timeline-title">New order received urgent</h6>-->
    <!--                                                        <p class="timeline-text">Melissa liked your activity.</p>-->
    <!--                                                        <div class="timeline-content orange-text">Important</div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-cyan active">-->
    <!--                                                        <div class="timeline-time">05 min</div>-->
    <!--                                                        <h6 class="timeline-title">System shutdown.</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content blue-text">Urgent</div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-red">-->
    <!--                                                        <div class="timeline-time">20 mins</div>-->
    <!--                                                        <h6 class="timeline-title">Database overloaded 89%</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content">-->
    <!--                                                            <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Database-log.doc-->
    <!--                                                        </div>-->
    <!--                                                    </li>-->
    <!--                                                </ul>-->
    <!--                                                <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>-->
    <!--                                                <ul class="widget-timeline mb-0">-->
    <!--                                                    <li class="timeline-items timeline-icon-green active">-->
    <!--                                                        <div class="timeline-time">10 min</div>-->
    <!--                                                        <h6 class="timeline-title">System error</h6>-->
    <!--                                                        <p class="timeline-text">Melissa liked your activity.</p>-->
    <!--                                                        <div class="timeline-content red-text">Error</div>-->
    <!--                                                    </li>-->
    <!--                                                    <li class="timeline-items timeline-icon-cyan">-->
    <!--                                                        <div class="timeline-time">1 min</div>-->
    <!--                                                        <h6 class="timeline-title">Production server down.</h6>-->
    <!--                                                        <p class="timeline-text">Here are some news feed interactions concepts.</p>-->
    <!--                                                        <div class="timeline-content blue-text">Urgent</div>-->
    <!--                                                    </li>-->
    <!--                                                </ul>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->

    <!--                            &lt;!&ndash; Slide Out Chat &ndash;&gt;-->
    <!--                            <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">-->
    <!--                                <li class="center-align pt-2 pb-2 sidenav-close chat-head">-->
    <!--                                    <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>-->
    <!--                                </li>-->
    <!--                                <li class="chat-body">-->
    <!--                                    <ul class="collection">-->
    <!--                                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                        <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                        </span>-->
    <!--                                            <div class="user-content speech-bubble">-->
    <!--                                                <p class="medium-small">hello!</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">How can we help? We're here for you!</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                        <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                        </span>-->
    <!--                                            <div class="user-content speech-bubble">-->
    <!--                                                <p class="medium-small">I am looking for the best admin template.?</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->

    <!--                                        <li class="collection-item display-grid width-100 center-align">-->
    <!--                                            <p>8:20 a.m.</p>-->
    <!--                                        </li>-->

    <!--                                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                        <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                        </span>-->
    <!--                                            <div class="user-content speech-bubble">-->
    <!--                                                <p class="medium-small">Ohh! very nice</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">Thank you.</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                        <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                        </span>-->
    <!--                                            <div class="user-content speech-bubble">-->
    <!--                                                <p class="medium-small">How can I purchase it?</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->

    <!--                                        <li class="collection-item display-grid width-100 center-align">-->
    <!--                                            <p>9:00 a.m.</p>-->
    <!--                                        </li>-->

    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">From ThemeForest.</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">Only $24</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                        <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                        </span>-->
    <!--                                            <div class="user-content speech-bubble">-->
    <!--                                                <p class="medium-small">Ohh! Thank you.</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                        <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar" />-->
    <!--                                        </span>-->
    <!--                                            <div class="user-content speech-bubble">-->
    <!--                                                <p class="medium-small">I will purchase it for sure.</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">Great, Feel free to get in touch on</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">-->
    <!--                                            <div class="user-content speech-bubble-right">-->
    <!--                                                <p class="medium-small">https://pixinvent.ticksy.com/</p>-->
    <!--                                            </div>-->
    <!--                                        </li>-->
    <!--                                    </ul>-->
    <!--                                </li>-->
    <!--                                <li class="center-align chat-footer">-->
    <!--                                    <form class="col s12" onsubmit="slideOutChat()" action="javascript:void(0);">-->
    <!--                                        <div class="input-field">-->
    <!--                                            <input id="icon_prefix" type="text" class="search" />-->
    <!--                                            <label for="icon_prefix">Type here..</label>-->
    <!--                                            <a onclick="slideOutChat()"><i class="material-icons prefix">send</i></a>-->
    <!--                                        </div>-->
    <!--                                    </form>-->
    <!--                                </li>-->
    <!--                            </ul>-->
                            </aside>
                            <!-- END RIGHT SIDEBAR NAV -->
                        </div>
                        <div class="content-overlay"></div>
                    </div>
                </div>
            </div>

            <footer class="page-footer footer footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow footer-fixed">
                <div class="footer-copyright">
                    <div class="container">
                        <span>&copy; 2020 <a href="#" target="_blank">Slaknoah</a> All rights reserved.</span>
                        <span class="right hide-on-small-only">Developed by <a href="#">Slaknoah</a></span>
                    </div>
                </div>
            </footer>
        </div>

        <div class="1-column auth-bg blank-page" key="logged-out" v-bind:style="{backgroundImage: 'url(' + loginImage + ')' }" v-else>
            <div class="row">
                <div class="col s12">
                    <router-view></router-view>
                    <div class="content-overlay"></div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import TheHeader from "./TheHeader";
import TheNavigation from "./TheNavigation";
import {mapGetters} from "vuex";

export default {
    name: 'App',
    data() {
        return {
            loginImage: '/img/flat-bg.jpg'
        }
    },
    components: {
        TheHeader,
        TheNavigation
    },
    methods: {
        initAppUI() {
            const sidenavMain = $(".sidenav-main"),
                contentOverlay = $(".content-overlay"),
                navCollapsible = $(".navbar .nav-collapsible"),
                breadcrumbsWrapper = $("#breadcrumbs-wrapper");

            // Menu: Default menu collapse check
            defaultMenuCollapse();
            function defaultMenuCollapse() {
                if ($("body").hasClass("menu-collapse") && $(window).width() > 993) {
                    //  Toggle navigation expan and collapse
                    sidenavMain.removeClass("nav-lock");
                    $(".nav-collapsible .navbar-toggler i").text("radio_button_unchecked");
                    navCollapsible.removeClass("sideNav-lock");
                    toggleMenuCollapse();
                    navigationCollapse();
                }
            }

            // Menu: Function for toggle class for menu collapse
            function toggleMenuCollapse() {
                if (sidenavMain.hasClass("nav-expanded") && !sidenavMain.hasClass("nav-lock")) {
                    sidenavMain.toggleClass("nav-expanded");
                    $("#main").toggleClass("main-full");
                } else {
                    $("#main").toggleClass("main-full");
                }
            }

            // Menu: Collapse navigation
            function navigationCollapse() {
                if (!$(".sidenav-main.nav-collapsible").hasClass("nav-lock")) {
                    const openLength = $(".collapsible .open").children().length;
                    $(".sidenav-main.nav-collapsible, .navbar .nav-collapsible")
                        .addClass("nav-collapsed")
                        .removeClass("nav-expanded");
                    $("#slide-out > li.open > a")
                        .parent()
                        .addClass("close")
                        .removeClass("open");
                    setTimeout(function () {
                        // Open only if collapsible have the children
                        if (openLength > 1) {
                            var collapseEl = $(".sidenav-main .collapsible");
                            var collapseInstance = M.Collapsible.getInstance(collapseEl);
                            collapseInstance.close($(".collapsible .close").index());
                        }
                    }, 100);
                }
            }

            $(function () {
                "use strict";

                // function for detect touch device
                function is_touch_device() {
                    const prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
                    const mq = function (query) {
                        return window.matchMedia(query).matches;
                    };

                    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
                        return true;
                    }
                    const query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
                    return mq(query);
                }

                // Plugin initialization
                //---------------------

                //Init tabs
                $(".tabs").tabs();

                // initialize datepicker
                $('.datepicker').datepicker({
                    autoClose: true,
                    format: 'dd/mm/yyyy',
                    container: 'body',
                    onDraw: function () {
                        // materialize select dropdown not proper working on mobile and tablets so we make it browser default select
                        $('.datepicker-container').find('.datepicker-select').addClass('browser-default');
                        $(".datepicker-container .select-dropdown.dropdown-trigger").remove()
                    }
                });

                // Swipe-able Tabs Demo Init
                if ($("#tabs-swipe-demo").length) {
                    $("#tabs-swipe-demo").tabs({
                        swipeable: true
                    });
                }

                $("select").formSelect();
                // Set checkbox on forms.html to indeterminate
                const indeterminateCheckbox = document.getElementById("indeterminate-checkbox");
                if (indeterminateCheckbox !== null) indeterminateCheckbox.indeterminate = true;

                // Materialize Slider
                $(".slider").slider({
                    full_width: true
                });

                // Common, Translation & Horizontal Dropdown
                $(".dropdown-trigger").dropdown();

                // Common, Translation
                $(".dropdown-button").dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrainWidth: false,
                    hover: true,
                    gutter: 0,
                    coverTrigger: true,
                    alignment: "left"
                });

                // Notification, Profile, Translation, Settings Dropdown & Horizontal Dropdown
                $(".notification-button, .profile-button, .translation-button, .dropdown-settings").dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrainWidth: false,
                    gutter: 0,
                    coverTrigger: false,
                    alignment: "right",
                    hover: false,
                    closeOnClick: true,
                });
                $(".dropdown-menu").dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrainWidth: false,
                    gutter: 0,
                    coverTrigger: false,
                    alignment: "right",
                    hover: false,
                    closeOnClick: false,
                });
                // horizontal nav nested dropdown
                $(".dropdownSub-menu").dropdown({
                    closeOnClick: false,
                    constrainWidth: false,
                    alignment: "left",
                    inDuration: 300,
                    outDuration: 225,
                    gutter: 0,
                    coverTrigger: true,
                    hover: true
                });

                // horizontal nested dropdown close and open on mouse enter and leave
                $(".dropdown-submenu").on("mouseenter", function () {
                    const $this = $(this);
                    $(this).find(".dropdownSub-menu").dropdown('open');
                    const dd = $this.find('.dropdown-content');
                    if (dd) {
                        const ddLeft = dd.offset().left,
                            ddWidth = dd.width();
                        // Add class to horizontal sub menu if screen width is small
                        if ($("html[data-textdirection='rtl']").length > 0) {
                            if (ddLeft >= ddWidth) {
                                $this.find(".dropdown-content").removeClass("right-open").addClass("left-open");
                            }
                            else {
                                $this.find(".dropdown-content").removeClass("left-open").addClass("right-open");
                            }
                        }
                        else {
                            if (((window.innerWidth) - (ddLeft + ddWidth)) <= (ddWidth)) {
                                $this.find(".dropdown-content").removeClass("left-open").addClass("right-open");
                            }
                            else {
                                $this.find(".dropdown-content").removeClass("right-open").addClass("left-open");
                            }
                        }
                    }
                });

                $(".dropdown-submenu").on("mouseleave", function () {
                    var $this = $(this);
                    $this.find(".dropdownSub-menu").dropdown('close');
                    // remove left and right open class in mouse leave
                    $this.find(".dropdown-content").removeClass("right-open");
                    $this.find(".dropdown-content").removeClass("left-open");
                });

                // Fab
                $(".fixed-action-btn").floatingActionButton();
                $(".fixed-action-btn.horizontal").floatingActionButton({
                    direction: "left"
                });
                $(".fixed-action-btn.click-to-toggle").floatingActionButton({
                    direction: "left",
                    hoverEnabled: false
                });
                $(".fixed-action-btn.toolbar").floatingActionButton({
                    toolbarEnabled: true
                });

                // Materialize Tabs
                $(".tab-demo")
                    .show()
                    .tabs();
                $(".tab-demo-active")
                    .show()
                    .tabs();

                // Materialize scrollSpy
                $(".scrollspy").scrollSpy();

                // Materialize tooltip
                $(".tooltipped").tooltip({
                    delay: 50
                });

                // Collapsible inside page not for sidebar
                const allCollapse = document.querySelectorAll(".collapsible");
                M.Collapsible.init(allCollapse);
                // Collapsible expandable
                const elem = document.querySelector('.collapsible.expandable');
                const instance = M.Collapsible.init(elem, {
                    accordion: false
                });

                // Breadcrumbs with bg image (vertical-dark-menu-template)
                if (breadcrumbsWrapper.attr("data-image")) {
                    const imageUrl = breadcrumbsWrapper.attr("data-image");
                    breadcrumbsWrapper.addClass("breadcrumbs-bg-image");
                    breadcrumbsWrapper.css("background-image", "url(" + imageUrl + ")");
                }

                // Main Menu (SideNav)
                //------------------
                const collapsibleSubCollapsible = $("li.active .collapsible-sub .collapsible");
                const sideMainCollapse = document.querySelectorAll(".sidenav-main .collapsible");

                // Init collapsible
                M.Collapsible.init(sideMainCollapse, {
                    accordion: true,
                    onOpenStart: function () {
                        // Removed open class first and add open at collapsible active
                        $(".collapsible > li.open").removeClass("open");
                        setTimeout(function () {
                            $("#slide-out > li.active > a")
                                .parent()
                                .addClass("open");
                        }, 10);
                    }
                });

                // Add open class on init
                if ($("body").hasClass("menu-collapse")) {
                    const sideNavCollapse = $(".sidenav-main .collapsible");
                    if ($("#slide-out > li.active").children().length > 1) {
                        $("#slide-out > li.active > a")
                            .parent()
                            .addClass("close");
                    }
                    M.Collapsible.getInstance(sideNavCollapse)
                        .close($(".collapsible .close")
                            .index())
                } else {
                    if ($("#slide-out > li.active").children().length > 1) {
                        $("#slide-out > li.active > a")
                            .parent()
                            .addClass("open");
                    }
                }

                // Open active menu for multi level
                if (collapsibleSubCollapsible.find("a.active").length > 0) {
                    collapsibleSubCollapsible
                        .find("a.active")
                        .closest("div.collapsible-body")
                        .show();
                    collapsibleSubCollapsible
                        .find("a.active")
                        .closest("div.collapsible-body")
                        .closest("li")
                        .addClass("active");
                }

                // Auto Scroll menu to the active item
                let position;
                if (
                    $(".sidenav-main li a.active")
                        .parent("li.active")
                        .parent("ul.collapsible-sub").length > 0
                ) {
                    position = $(".sidenav-main li a.active")
                        .parent("li.active")
                        .parent("ul.collapsible-sub")
                        .position();
                } else {
                    position = $(".sidenav-main li a.active")
                        .parent("li.active")
                        .position();
                }
                setTimeout(function () {
                    if (position !== undefined) {
                        $(".sidenav-main ul")
                            .stop()
                            .animate({ scrollTop: position.top - 300 }, 300);
                    }
                }, 300);

                // On SideNav toggle button click: collapse menu
                $(".nav-collapsible .navbar-toggler").click(function () {
                    // Toggle navigation expan and collapse on radio click
                    toggleMenuCollapse();
                    // Set navigation lock / unlock with radio icon
                    if ($(this).children().text() === "radio_button_unchecked") {
                        $(this)
                            .children()
                            .text("radio_button_checked");
                        sidenavMain.addClass("nav-lock");
                        navCollapsible.addClass("sideNav-lock");
                    } else {
                        $(this)
                            .children()
                            .text("radio_button_unchecked");
                        sidenavMain.removeClass("nav-lock");
                        navCollapsible.removeClass("sideNav-lock");
                    }
                });

                // Expand navigation on mouseenter event
                $(".sidenav-main.nav-collapsible, .navbar .brand-sidebar").mouseenter(function () {
                    if (!$(".sidenav-main.nav-collapsible").hasClass("nav-lock")) {
                        $(".sidenav-main.nav-collapsible, .navbar .nav-collapsible")
                            .addClass("nav-expanded")
                            .removeClass("nav-collapsed");
                        $("#slide-out > li.close > a")
                            .parent()
                            .addClass("open")
                            .removeClass("close");
                        setTimeout(function () {
                            // Open only if collapsible have the children
                            if ($(".collapsible .open").children().length > 1) {
                                var collapseEl = $(".sidenav-main .collapsible");
                                var collapseInstance = M.Collapsible.getInstance(collapseEl);
                                collapseInstance.open($(".collapsible .open").index());
                            }
                        }, 100);
                    }
                });

                // Collapse navigation on mouseleave event
                $(".sidenav-main.nav-collapsible, .navbar .brand-sidebar").mouseleave(function () {
                    navigationCollapse();
                });

                // Right side slide-out
                //---------------------

                //Main Left Sidebar Menu // sidebar-collapse
                $(".sidenav").sidenav({
                    edge: "left" // Choose the horizontal origin
                });

                //Main Right Sidebar
                $(".slide-out-right-sidenav").sidenav({
                    edge: "right"
                });

                //Main Right Sidebar Chat
                $(".slide-out-right-sidenav-chat").sidenav({
                    edge: "right"
                });

                // check for if touch device
                if (!is_touch_device()) {
                    // Right side slide-out (Chat, settings & timeline)
                    if ($("#slide-out.leftside-navigation").length > 0) {
                        if (!$("#slide-out.leftside-navigation").hasClass("native-scroll")) {
                            var ps_leftside_nav = new PerfectScrollbar(".leftside-navigation", {
                                wheelSpeed: 2,
                                wheelPropagation: false,
                                minScrollbarLength: 20
                            });
                        }
                    }
                    if ($(".slide-out-right-body").length > 0) {
                        var ps_slideout_right = new PerfectScrollbar(".slide-out-right-body, .chat-body .collection", {
                            suppressScrollX: true,
                            wheelPropagation: false
                        });
                    }
                    if ($(".chat-body .collection").length > 0) {
                        var ps_slideout_chat = new PerfectScrollbar(".chat-body .collection", {
                            suppressScrollX: true
                        });
                    }
                    // for horizonatal nav scroll
                    if ($("#ul-horizontal-nav").length > 0) {
                        var ps_horizontal_nav = new PerfectScrollbar("#ul-horizontal-nav", {
                            wheelPropagation: false,
                        });
                    }

                    $("#ul-horizontal-nav").on("mouseenter", function () {
                        ps_horizontal_nav.update();
                    })
                }
                else {
                    $('.leftside-navigation,.slide-out-right-body, .chat-body .collection, #ul-horizontal-nav').css('overflow', "scroll");
                }

                // Fullscreen
                function toggleFullScreen() {
                    if (
                        (document.fullScreenElement && document.fullScreenElement !== null) ||
                        (!document.mozFullScreen && !document.webkitIsFullScreen)
                    ) {
                        if (document.documentElement.requestFullScreen) {
                            document.documentElement.requestFullScreen();
                        } else if (document.documentElement.mozRequestFullScreen) {
                            document.documentElement.mozRequestFullScreen();
                        } else if (document.documentElement.webkitRequestFullScreen) {
                            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                        } else if (document.documentElement.msRequestFullscreen) {
                            if (document.msFullscreenElement) {
                                document.msExitFullscreen();
                            } else {
                                document.documentElement.msRequestFullscreen();
                            }
                        }
                    } else {
                        if (document.cancelFullScreen) {
                            document.cancelFullScreen();
                        } else if (document.mozCancelFullScreen) {
                            document.mozCancelFullScreen();
                        } else if (document.webkitCancelFullScreen) {
                            document.webkitCancelFullScreen();
                        }
                    }
                }
                $(".toggle-fullscreen").click(function () {
                    toggleFullScreen();
                });

                // Detect touch screen and enable scrollbar if necessary
                function is_touch_device() {
                    try {
                        document.createEvent("TouchEvent");
                        return true;
                    } catch (e) {
                        return false;
                    }
                }
                if (is_touch_device()) {
                    $("#nav-mobile").css({
                        overflow: "auto"
                    });
                }

                // RTL specific
                if ($("html[data-textdirection='rtl']").length > 0) {
                    //Main Left Sidebar Menu // sidebar-collapse
                    $(".sidenav").sidenav({
                        edge: "right" // Choose the horizontal origin
                    });
                    $(".slide-out-right-sidenav").sidenav({
                        edge: "left"
                    });
                    //Main Right Sidebar Chat
                    $(".slide-out-right-sidenav-chat").sidenav({
                        edge: "left"
                    });
                }

                // On search input focus, Add search focus class
                $(".header-search-input")
                    .focus(function () {
                        $(this)
                            .parent("div")
                            .addClass("header-search-wrapper-focus");
                    })
                    .blur(function () {
                        $(this)
                            .parent("div")
                            .removeClass("header-search-wrapper-focus");
                    });

                //Search box form small screen
                const searchSm = $(".search-sm"),
                    searchBoxSm = $(".search-input-sm .search-box-sm");
                $(".search-button").click(function (e) {
                    if (searchSm.is(":hidden")) {
                        searchSm.show();
                        searchBoxSm.focus();
                    } else {
                        searchSm.hide();
                        searchBoxSm.val("");
                    }
                });
                $(".search-sm-close").click(function (e) {
                    searchSm.hide();
                    searchBoxSm.val("");
                });
            });

            //Collapse menu on below 994 screen
            $(window).on("resize", function () {
                if ($(window).width() < 994) {
                    if (sidenavMain.hasClass("nav-collapsed")) {
                        sidenavMain.removeClass("nav-collapsed").addClass("nav-lock nav-expanded");
                        navCollapsible.removeClass("nav-collapsed").addClass("sideNav-lock");
                    }
                } else if ($(window).width() > 993 && $("body").hasClass("menu-collapse")) {
                    if (sidenavMain.hasClass("nav-lock")) {
                        sidenavMain.removeClass("nav-lock nav-expanded").addClass("nav-collapsed");
                        navCollapsible.removeClass("sideNav-lock").addClass("nav-collapsed");
                    }
                }
            });
        }
    },
    computed: {
        ...mapGetters([
            'isLoggedIn',
            'getAuthUser'
        ])
    },
    created() {
        /**
         * Get all necessary data for app init
         */

        // Roles
        if(this.$store.getters.isLoggedIn) {
            this.$store.dispatch('fetchRoles');
        }
        this.initAppUI();
    },
    watch: {
        isLoggedIn(newValue) {
            if(newValue) {
                setTimeout(() => {
                    this.$nextTick(() => {
                        this.initAppUI();
                    });
                }, 1000);
            }
        }
    }
}
</script>


<style lang="scss">
    body { overflow-x: hidden }

    .load-enter-active, .load-leave-active {
        transition: opacity .5s ease;
    }

    .load-enter, .load-leave-to {
        opacity: 0;
    }

    .auth-bg{
        background-repeat: no-repeat;
        background-size: cover;
    }

    .auth-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .page-footer.footer-fixed {
        z-index: 2;
    }
</style>