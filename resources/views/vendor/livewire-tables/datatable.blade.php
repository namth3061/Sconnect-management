@php($tableName = $this->getTableName)
@php($tableId = $this->getTableId)
@php($primaryKey = $this->getPrimaryKey)
@php($isTailwind = $this->isTailwind)
@php($isBootstrap = $this->isBootstrap)
@php($isBootstrap4 = $this->isBootstrap4)
@php($isBootstrap5 = $this->isBootstrap5)

<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ $pageTitle ?? 'List'}}</h4>
                    </div>
                    <div class="card-action">
                        @if(isset($routeCreate))
                            <a href="{{$routeCreate}}" class="mt-lg-0 mt-md-0 mt-3 btn btn-primary btn-icon">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </i>
                                <span>{{ $headerAction }}</span>
                            </a>
                        @else
                            <a href="#" class="mt-lg-0 mt-md-0 mt-3 btn btn-primary btn-icon" data-bs-toggle="tooltip"
                               data-modal-form="form" data-icon="person_add" data-size="{{ $modalSize }}"
                               data--href="{{ $showFromCreate }}" data-app-title="{{ $headerAction }}"
                               data-placement="top" title="{{ $headerAction }}">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </i>
                                <span>{{ $headerAction }}</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <div style="margin: 10px">
                            <div x-data="laravellivewiretable($wire, '{{ $this->showBulkActionsDropdownAlpine() }}', '{{ $tableId }}', '{{ $primaryKey }}')">
                                <x-livewire-tables::wrapper :component="$this" :tableName="$tableName" :$primaryKey :$isTailwind :$isBootstrap :$isBootstrap4 :$isBootstrap5>
                                    @if ($this->hasConfigurableAreaFor('before-tools'))
                                        @include($this->getConfigurableAreaFor('before-tools'), $this->getParametersForConfigurableArea('before-tools'))
                                    @endif

                                    <x-livewire-tables::tools>
                                        @if ($this->showSortPillsSection)
                                            <x-livewire-tables::tools.sorting-pills />
                                        @endif
{{--                                        @if($this->showFilterPillsSection)--}}
{{--                                            <x-livewire-tables::tools.filter-pills />--}}
{{--                                        @endif--}}
                                        <x-livewire-tables::tools.toolbar :$filterGenericData />
                                    </x-livewire-tables::tools>

                                    <x-livewire-tables::table>

                                        <x-slot name="thead">
                                            @if($this->getCurrentlyReorderingStatus)
                                                <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus" />
                                            @endif
                                            @if($this->showBulkActionsSections)
                                                <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
                                            @endif
                                            @if ($this->showCollapsingColumnSections)
                                                <x-livewire-tables::table.th.collapsed-columns />
                                            @endif

                                            @foreach($selectedVisibleColumns as $index => $column)
                                                <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :column="$column" :index="$index" />
                                            @endforeach
                                        </x-slot>

                                        @if($this->secondaryHeaderIsEnabled() && $this->hasColumnsWithSecondaryHeader())
                                            <x-livewire-tables::table.tr.secondary-header :rows="$rows" :$filterGenericData :$selectedVisibleColumns  />
                                        @endif
                                        @if($this->hasDisplayLoadingPlaceholder())
                                            <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
                                        @endif


                                        @if($this->showBulkActionsSections)
                                            <x-livewire-tables::table.tr.bulk-actions :rows="$rows" :displayMinimisedOnReorder="true" />
                                        @endif

                                        @forelse ($rows as $rowIndex => $row)
                                            <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $row->{$primaryKey} }}" :row="$row" :rowIndex="$rowIndex">
                                                @if($this->getCurrentlyReorderingStatus)
                                                    <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-row-reorder-{{ $row->{$primaryKey} }}" :rowID="$tableName.'-'.$row->{$this->getPrimaryKey()}" :rowIndex="$rowIndex" />
                                                @endif
                                                @if($this->showBulkActionsSections)
                                                    <x-livewire-tables::table.td.bulk-actions wire:key="{{ $tableName }}-row-bulk-act-{{ $row->{$primaryKey} }}" :row="$row" :rowIndex="$rowIndex"/>
                                                @endif
                                                @if ($this->showCollapsingColumnSections)
                                                    <x-livewire-tables::table.td.collapsed-columns wire:key="{{ $tableName }}-row-collapsed-{{ $row->{$primaryKey} }}" :rowIndex="$rowIndex" />
                                                @endif

                                                @foreach($selectedVisibleColumns as $colIndex => $column)
                                                    <x-livewire-tables::table.td wire:key="{{ $tableName . '-' . $row->{$primaryKey} . '-datatable-td-' . $column->getSlug() }}"  :column="$column" :colIndex="$colIndex">
                                                        @if($column->isHtml())
                                                            {!! $column->renderContents($row) !!}
                                                        @else
                                                            {{ $column->renderContents($row) }}
                                                        @endif
                                                    </x-livewire-tables::table.td>
                                                @endforeach
                                            </x-livewire-tables::table.tr>

                                            @if ($this->showCollapsingColumnSections)
                                                <x-livewire-tables::table.collapsed-columns :row="$row" :rowIndex="$rowIndex" />
                                            @endif
                                        @empty
                                            <x-livewire-tables::table.empty />
                                        @endforelse

                                        @if ($this->footerIsEnabled() && $this->hasColumnsWithFooter())
                                            <x-slot name="tfoot">
                                                @if ($this->useHeaderAsFooterIsEnabled())
                                                    <x-livewire-tables::table.tr.secondary-header :rows="$rows" :$filterGenericData />
                                                @else
                                                    <x-livewire-tables::table.tr.footer :rows="$rows"  :$filterGenericData />
                                                @endif
                                            </x-slot>
                                        @endif
                                    </x-livewire-tables::table>

                                    <x-livewire-tables::pagination :rows="$rows" />

                                    @includeIf($customView)
                                </x-livewire-tables::wrapper>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
