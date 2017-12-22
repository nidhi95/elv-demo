<style>
    .input-group-btn button {
        padding: 12px 11px;
    }
</style>
<div class="row">

    <div class="<% vm.selected_sub_tab.filterCls.date %>" ng-if=" vm.selected_sub_tab.filter.date" style="margin-bottom: 10px">
        <div class="input-group" style="width: 100%" ng-init="opens = false">
            <span class="input-group-addon" id="basic-addon1">From</span>
            <input type="text" class="form-control"
                   id="Stardate"
                   style="height: 3.29em;"
                   ng-change="vm.filterFn()"
                   uib-datepicker-popup="<% vm.format %>"
                   ng-model="vm.filter.fromDate"
                   is-open="opens"
                   min-date="minDate"
                   datepicker-options="dateOptions"
                   date-disabled="disabled(date, mode)"
                   close-text="Close"/>
            <span class="input-group-btn">
                <button type="button" class="btn btn-default"
                        ng-click="open($event); opens = !opens">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>

        </div>

    </div>
    <div class="<% vm.selected_sub_tab.filterCls.date %>" ng-if=" vm.selected_sub_tab.filter.date" style="margin-bottom: 10px">
        <div class="input-group" style="width: 100%" ng-init="opene = false">
            <span class="input-group-addon" id="basic-addon1">To</span>
            <input type="text" class="form-control"
                   id="Stardate"
                   uib-datepicker-popup="<%  vm.format %>"
                   ng-model="vm.filter.toDate"
                   ng-change="vm.filterFn()"
                   style="height: 3.29em;"
                   is-open="opene"
                   max-date="<% vm.minDate %>"
                   datepicker-options="dateOptions"
                   date-disabled="disabled(date, mode)"
                   close-text="Close"/>
            <span class="input-group-btn">
                <button type="button" class="btn btn-default"
                        ng-click="open($event); opene = !opene">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>

        </div>

    </div>


    <div class="<% vm.selected_sub_tab.filterCls.status %>" ng-if=" vm.selected_sub_tab.filter.status">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Status</span>
            <select class="form-control" ng-model="vm.filter.status"
                    ng-change="vm.filterFn()"
                    ng-options="item for item in vm.status">
            </select>
        </div>


    </div>
    <div class="<% vm.selected_sub_tab.filterCls.shape %>" ng-if=" vm.selected_sub_tab.filter.shape">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Shape</span>
            <select class="form-control" ng-model="vm.filter.shape"
                    ng-change="vm.filterFn()"
                    ng-options="item for item in vm.shapes">
            </select>
        </div>


    </div>

    <div class="<% vm.selected_sub_tab.filterCls.search %>" ng-if=" vm.selected_sub_tab.filter.search">
        <form ng-submit="vm.filterFn()">

            <div class="input-group">
                <input type="text" class="form-control"
                       placeholder="Search" ng-model="vm.filter.search">
                <span class="input-group-addon"
                      ng-click="vm.filterFn()"
                      id="basic-addon2">
                    <i class="fa fa-search"></i>
                </span>
            </div>

        </form>
    </div>
</div>