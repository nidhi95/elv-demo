<div class="modal fade modal-md" id="searchByStock" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 88%">
            <div class="modal-header backgroung-theme" style="border-bottom: 1px solid #ccc">
                <button type="button" class="close pull-right"
                        data-dismiss="modal">&times;</button>
                <h2 class="modal-title" id="myModalLabel">
                    Search By Stock
                </h2>
            </div>
            <div class="modal-body backgroung-theme" loader id="loadingArea" style="padding:0.5% 0">
                <div class="promo-block-v9 full-width-container"
                     ng-if="!vm.showErr"
                     id="product-content">

                    <div class="row margin-l-0 margin-r-0" style="padding: 0">
                        <iframe name="searchStockReport"
                                style="border: none !important;width: 100%;height: 30em;"
                                id="searchStockReport" src=""></iframe>
                    </div>

                    <div class="col-md-12">
                        <button type="button" class="pull-right btn btn-lg btn-md btn-sm btn-default"
                                ng-click="vm.searchByStockResFilterFn()"> View Result
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>