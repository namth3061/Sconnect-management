let item = null;

Livewire.on('data-ajax-edit', ($data) => {
    item = $data;
    getSelectedValue();
});

Livewire.on('data-edit', ($data) => {
    for (const [key, value] of Object.entries($data[0])) {
        if (Array.isArray(value) && value.length > 0) {
            value.forEach((valueItem) => {
                $(`[name="${key}"]`).val(valueItem).trigger('change');
            });
        } else {
            $(`[name="${key}"]`).val(value).trigger('change');
        }
    }
});

Livewire.on('reset-select2', () => {
    $(".select2-component").each(function () {
        $(this).val(null).trigger('change');
    });
});

function getSelectedValue() {
    if (!item) {
        return;
    }

    for (const [key, value] of Object.entries(item[0])) {
        $(".select2-component").each(function () {
            const getUrl = $(`[name="${key}"]`).data("url");
            $.ajax({
                url: getUrl,
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    data: value
                },
                success: function (data) {
                    if (data.status === 200) {
                        updateSelectValues(key, data.item);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error(`An error occurred: ${error}`, 'Error', {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 5000,
                        extendedTimeOut: 1000,
                        positionClass: "toast-top-right"
                    });
                }
            });

        });
    }
}

function selectValue(dropdownParent = '') {
    $(".select2-component").each(function () {
        const $select = $(this);
        const selectName = $select.attr('name');
        const options = $select.data('option');

        if ($select.hasClass('select2-hidden-accessible')) {
            return;
        }

        if (!options || options.length === 0) {
            select2Ajax($select, dropdownParent);
        } else {
            select2Default($select, dropdownParent);
        }

        $select.on("change", function () {
            var data = $select.val();
            if (data) {
                Livewire.dispatch(selectName, [data]);
            }
        });
    });
}

function updateSelectValues(selectName, data) {
    const selectElement = $(`[name="${selectName}"]`);
    selectElement.empty();

    if (Array.isArray(data) && data.length > 0) {
        data.forEach((value) => {
            if (value.id && value.name) {
                selectElement.append(new Option(value.name, value.id));
            }
        });

        const ids = data.map(value => value.id);
        selectElement.val(ids).trigger("change");
    } else if (typeof data === 'object' && data !== null) {
        const { id, name } = data;
        selectElement.append(new Option(name, id));
        selectElement.val(id, name).trigger("change");
    } else {
        console.warn(`Unexpected value for ${selectName}`);
    }

}

function select2Ajax($select, dropdownParent) {
    const getUrl = $select.data('url');
    $select.select2({
        width: "100%",
        theme: "bootstrap-5",
        closeOnSelect: true,
        allowClear: true,
        dropdownParent: dropdownParent,
        ajax: {
            url: getUrl,
            method: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: function (params) {
                return {
                    query: params.term,
                    page: params.page || 1,
                    perPage: 10,
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                if (data.status === 200) {
                    return {
                        results: data.data.items.map(item => ({
                            id: item.id,
                            text: item.name,
                        })),
                        pagination: {
                            more: data.total > params.page * 10
                        },
                    };
                }
            },
            error: function (xhr, status, error) {
                toastr.error(`An error occurred: ${error}`, 'Error', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000,
                    extendedTimeOut: 1000,
                    positionClass: "toast-top-right"
                });
            }
        }

    });
}

function select2Default($select, dropdownParent) {
    $select.select2({
        width: "100%",
        closeOnSelect: true,
        theme: "bootstrap-5",
        allowClear: true,
        dropdownParent: dropdownParent,
    });
}
