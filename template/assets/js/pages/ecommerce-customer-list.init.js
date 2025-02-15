var url = "assets/json/",
    customerListData = "",
    editList = !1,
    getJSON = function (e, t) {
        var a = new XMLHttpRequest();
        a.open("GET", url + e, !0),
            (a.responseType = "json"),
            (a.onload = function () {
                var e = a.status;
                t(200 === e ? null : e, a.response);
            }),
            a.send();
    };
function loadCustomerList(e) {
    $("#customerList-table").DataTable({
        data: e,
        bLengthChange: !1,
        order: [[0, "desc"]],
        language: {
            oPaginate: {
                sNext: '<i class="mdi mdi-chevron-right"></i>',
                sPrevious: '<i class="mdi mdi-chevron-left"></i>',
            },
        },
        columns: [
            {
                data: "id",
                render: function (e, t, a) {
                    return (
                        '<div class="d-none">' +
                        a.id +
                        '</div>                    <div class="form-check font-size-16">                        <input class="form-check-input" type="checkbox" id="customerlistcheck-' +
                        a.id +
                        '">                        <label class="form-check-label" for="customerlistcheck-' +
                        a.id +
                        '"></label>                    </div>'
                    );
                },
            },
            { data: "userName" },
            { data: "email" },
            { data: "phone" },
            {
                data: "rating",
                render: function (e, t, a) {
                    return (
                        '<span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> ' +
                        a.rating +
                        "</span>"
                    );
                },
            },
            { data: "balance" },
            { data: "joinDate" },
            {
                data: null,
                bSortable: !1,
                render: function (e, t, a) {
                    return (
                        '<div class="dropdown">                <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">                    <i class="mdi mdi-dots-horizontal font-size-18"></i>                </a>                <ul class="dropdown-menu dropdown-menu-end">                    <li><a href="#newCustomerModal" data-bs-toggle="modal" class="dropdown-item edit-list" data-edit-id="' +
                        a.id +
                        '"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>                    <li><a href="#removeItemModal" data-bs-toggle="modal" class="dropdown-item remove-list" data-remove-id="' +
                        a.id +
                        '"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Delete</a></li>                </ul>            </div>'
                    );
                },
            },
        ],
        drawCallback: function (e) {
            editCustomerList(), removeItem();
        },
    }),
        $("#searchTableList").keyup(function () {
            $("#customerList-table").DataTable().search($(this).val()).draw();
        }),
        $(".dataTables_length select").addClass("form-select form-select-sm"),
        $(".dataTables_paginate").addClass("pagination-rounded"),
        $(".dataTables_filter").hide();
}
getJSON("ecommerce-customer-list.json", function (e, t) {
    null !== e
        ? console.log("Something went wrong: " + e)
        : loadCustomerList((customerListData = t));
});
var date = new Date(),
    today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
$("#joindate-input").datepicker("setDate", today);
var createCustomerForms = document.querySelectorAll(".createCustomer-form");
function fetchIdFromObj(e) {
    return parseInt(e.id);
}
function findNextId() {
    if (0 === customerListData.length) return 0;
    var e = fetchIdFromObj(customerListData[customerListData.length - 1]),
        t = fetchIdFromObj(customerListData[0]);
    return e <= t ? t + 1 : e + 1;
}
function editCustomerList() {
    var a;
    Array.from(document.querySelectorAll(".edit-list")).forEach(function (t) {
        t.addEventListener("click", function (e) {
            (a = t.getAttribute("data-edit-id")),
                (editList = !0),
                document
                    .getElementById("createCustomer-form")
                    .classList.remove("was-validated"),
                (customerListData = customerListData.map(function (e) {
                    return (
                        e.id == a &&
                            ((document.getElementById(
                                "newCustomerModalLabel"
                            ).innerHTML = "Edit Profile"),
                            (document.getElementById(
                                "addCustomer-btn"
                            ).innerHTML = "Update"),
                            (document.getElementById("userid-input").value =
                                e.id),
                            (document.getElementById("username-input").value =
                                e.userName),
                            (document.getElementById("email-input").value =
                                e.email),
                            (document.getElementById("phone-input").value =
                                e.phone),
                            $("#joindate-input").datepicker(
                                "setDate",
                                e.joinDate
                            )),
                        e
                    );
                }));
        });
    });
}
function removeItem() {
    var a;
    Array.from(document.querySelectorAll(".remove-list")).forEach(function (t) {
        t.addEventListener("click", function (e) {
            (a = t.getAttribute("data-remove-id")),
                document
                    .getElementById("remove-item")
                    .addEventListener("click", function () {
                        var t,
                            e =
                                ((t = a),
                                customerListData.filter(function (e) {
                                    return e.id != t;
                                }));
                        (customerListData = e),
                            $.fn.DataTable.isDataTable("#customerList-table") &&
                                $("#customerList-table").DataTable().destroy(),
                            loadCustomerList(customerListData),
                            document
                                .getElementById("close-removeCustomerModal")
                                .click();
                    });
        });
    });
}
Array.prototype.slice.call(createCustomerForms).forEach(function (s) {
    s.addEventListener(
        "submit",
        function (e) {
            var t, a, n, i, d, o;
            s.checkValidity()
                ? (e.preventDefault(),
                  (t = document.getElementById("username-input").value),
                  (a = document.getElementById("email-input").value),
                  (n = document.getElementById("phone-input").value),
                  (i = document.getElementById("joindate-input").value),
                  "" === t || "" === a || "" === n || "" === i || editList
                      ? "" !== t &&
                        "" !== a &&
                        "" !== n &&
                        "" !== i &&
                        editList &&
                        ((d = 0),
                        (d = document.getElementById("userid-input").value),
                        (customerListData = customerListData.map(function (e) {
                            return e.id != d
                                ? e
                                : {
                                      id: d,
                                      userName: t,
                                      email: a,
                                      phone: n,
                                      rating: e.rating,
                                      balance: e.balance,
                                      joinDate: i,
                                  };
                        })),
                        (editList = !1))
                      : ((o = {
                            id: findNextId(),
                            userName: t,
                            email: a,
                            phone: n,
                            rating: "--",
                            balance: "$00",
                            joinDate: i,
                        }),
                        customerListData.push(o)),
                  $.fn.DataTable.isDataTable("#customerList-table") &&
                      $("#customerList-table").DataTable().destroy(),
                  loadCustomerList(customerListData),
                  $("#newCustomerModal").modal("hide"))
                : (e.preventDefault(), e.stopPropagation()),
                s.classList.add("was-validated");
        },
        !1
    );
}),
    Array.from(document.querySelectorAll(".addCustomers-modal")).forEach(
        function (e) {
            e.addEventListener("click", function (e) {
                (editList = !1),
                    document
                        .getElementById("createCustomer-form")
                        .classList.remove("was-validated"),
                    (document.getElementById(
                        "newCustomerModalLabel"
                    ).innerHTML = "Add Customer"),
                    (document.getElementById("addCustomer-btn").innerHTML =
                        "Add Customer"),
                    (document.getElementById("userid-input").value = ""),
                    (document.getElementById("username-input").value = ""),
                    (document.getElementById("email-input").value = ""),
                    (document.getElementById("phone-input").value = ""),
                    $("#joindate-input").datepicker("setDate", today);
            });
        }
    );
