<div class="dropdown">
    <a id="header-menu-myprofile-link" class="dropdown-toggle" data-toggle="dropdown" href="/search" onclick="event.preventDefault()">Search</a>
    <div class="popover dropdown-menu" role="menu" aria-labelledby="header-menu-myprofile-link">
        <div class="popover-content">
            <div class="arrow"><span></span></div>
            <div class="popover-body">
                <div class="popover-body-inner">
                    
                    <?php include_once 'sidebar.php'; ?>

                  <!--   <div id="sidebar-filters" class="sidebar-section vevent" itemscope="" itemtype="http://schema.org/Event">
                      <div id="sidebar-filters-type">
                          <ul>
                              <li id="sidebar-search">
                                  <form action="/" method="get">
                                      <input type="text" id="s" name="s" class="swap" value="Schedule or People" style="color: rgb(204, 204, 204);">&nbsp;
                                      <input id="s-submit" type="submit" value="Search" class="button-submit">
                                      <br>
                                      <a href="/search" style="margin:5px 2px 0;padding:0 !important;float:none;" id="sidebar-search-note">or browse by date + venue</a>
                                  </form>
                              </li>
                              <li id="type-1" class="lev1 ev_1"><a title="View 5 Hall Events" href="/overview/type/Hall"><span class="box"></span> Hall</a></li>
                              <li id="type-2" class="lev1 ev_2"><a title="View 16 Main assembly room Events" href="/overview/type/Main+assembly+room"><span class="box"></span> Main assembly room</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/overview/type/Main+assembly+room">All</a></li>
                                                      <li id="type-2-subtype-1" class=""><a title="View 2 Call for Impact Main assembly room Events" href="/overview/type/main-assembly-room/Call+for+Impact">Call for Impact</a></li>
                                                      <li id="type-2-subtype-2" class=""><a title="View 8 Sharing session Main assembly room Events" href="/overview/type/main-assembly-room/Sharing+session">Sharing session</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li id="type-3" class="lev1 ev_3"><a title="View 12 Room A Events" href="/overview/type/Room+A"><span class="box"></span> Room A</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/overview/type/Room+A">All</a></li>
                                                      <li id="type-3-subtype-1" class=""><a title="View 1 Action session Room A Events" href="/overview/type/room-a/Action+session">Action session</a></li>
                                                      <li id="type-3-subtype-2" class=""><a title="View 5 Call for Impact Room A Events" href="/overview/type/room-a/Call+for+Impact">Call for Impact</a></li>
                                                      <li id="type-3-subtype-3" class=""><a title="View 6 Sharing session Room A Events" href="/overview/type/room-a/Sharing+session">Sharing session</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li id="type-4" class="lev1 ev_4"><a title="View 11 Room B Events" href="/overview/type/Room+B"><span class="box"></span> Room B</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/overview/type/Room+B">All</a></li>
                                                      <li id="type-4-subtype-1" class=""><a title="View 1 Action session Room B Events" href="/overview/type/room-b/Action+session">Action session</a></li>
                                                      <li id="type-4-subtype-2" class=""><a title="View 5 Call for Impact Room B Events" href="/overview/type/room-b/Call+for+Impact">Call for Impact</a></li>
                                                      <li id="type-4-subtype-3" class=""><a title="View 5 Sharing session Room B Events" href="/overview/type/room-b/Sharing+session">Sharing session</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li id="type-5" class="lev1 ev_5"><a title="View 12 Room C Events" href="/overview/type/Room+C"><span class="box"></span> Room C</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/overview/type/Room+C">All</a></li>
                                                      <li id="type-5-subtype-1" class=""><a title="View 1 Action session Room C Events" href="/overview/type/room-c/Action+session">Action session</a></li>
                                                      <li id="type-5-subtype-2" class=""><a title="View 1 Call for Impact Room C Events" href="/overview/type/room-c/Call+for+Impact">Call for Impact</a></li>
                                                      <li id="type-5-subtype-3" class=""><a title="View 1 My best Open Data Fail Room C Events" href="/overview/type/room-c/My+best+Open+Data+Fail">My best Open Data Fail</a></li>
                                                      <li id="type-5-subtype-4" class=""><a title="View 6 Sharing session Room C Events" href="/overview/type/room-c/Sharing+session">Sharing session</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li style="clear:left"></li>
                              <li class="lev1 ev_tags" id="filter-menutag-company"><a href="#" rel="company" title="Impact"><span class="box"></span>Impact</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/company/Impact">Impact</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="lev1 ev_tags" id="filter-menutag-audience"><a href="#" rel="audience" title="Sharing"><span class="box"></span>Sharing</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/audience/Sharing">Sharing</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="lev1 ev_tags" id="filter-menutag-subject"><a href="#" rel="subject" title="Action"><span class="box"></span>Action</a>
                                  <div class="popover">
                                      <div class="popover-content">
                                          <div class="arrow"><span></span></div>
                                          <div class="popover-body">
                                              <div class="popover-body-inner">
                                                  <ul>
                                                      <li><a href="/subject/Action">Action</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <br class="s-clr">
                                  </div>  --><!-- //side bar filters -->




            </div>
        </div>
    </div>
</div>
