<div id="c-menu--slide-right" class="c-menu c-menu--slide-right">
    <div class="col-md-12">
        <a ng-click=" vm.checkCustomizeFn()"
           class="btn btn-sm  btn-dark-bg-slide btn-slide btn-slide-right btn-base-sm move-to-bag">
            Reset
        </a>
        <a ng-click=" vm.applyCustomizationFn()"
                class="btn btn-sm btn-dark-bg-slide btn-slide btn-slide-right btn-base-sm move-to-bag">Apply
        </a>

        <div style="text-align: right; position: relative; display: block; height: 25px; top: 10px"
             class="col-md-2 pull-right">
            <a class="sidebar-trigger sidebar-nav-trigger is-clicked c-menu__close " href="javascript:void(0);">
                <span class="sidebar-trigger-icon"></span>
            </a>
        </div>
    </div>

    <div class="sidebar-nav-content">

        <nav class="menu scroll-style-4">
            <div class="filter_content">
                <div class="accordion-v5">
                    <div class="panel-group" id="customize" role="tablist" aria-multiselectable="true">

                        {{--<pre> <% vm.customize_data | json %></pre>--}}

                        <div class="panel panel-default" ng-repeat="(key,value) in vm.customize_data">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#customize"
                                       href="#metal-type<% $index+1 %>" aria-expanded="false"
                                       ng-click="vm.customizeByFn(key, $index+1);"
                                       aria-controls="metal-type">
                                        <% value[0].main_type %> <br/>

                                        {{--ng-show="vm.filter[category.reqKey] && !category.open"--}}
                                        {{--ng-show="vm.currentOpen != key"--}}
                                        <span ng-hide="vm.currentOpen == key" style="font-size: 12px;">
                                            <% value | checkedshow %>
                                        </span>
                                    </a>
                                </h4>
                            </div>
                            <div id="metal-type<% $index+1 %>" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="fd-fieldcontainer filter">
                                        <div class="customize_blck" ng-repeat="data in value">
                                            <div class="check_input_box">
                                                <input type="checkbox"
                                                       ng-model="data.checked"
                                                       ng-change="vm.checkCustomizeFn(key,data.name,data.checked)"
                                                       id="all<% data.name +($index+1) %>" class="chk price-chk"
                                                       style="display: block;">

                                                <div class="check_input chk" style="display: inline-block;"></div>
                                            </div>
                                            <label style="font-size: 15px;font-weight: 300;"
                                                   for="all<% data.name +($index+1) %>"><% data.name %></label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<div id="c-mask" class="c-mask"></div>