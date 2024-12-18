"use strict";
var KTCreateAccount = (function () {
    var e,
        t,
        i,
        o,
        a,
        r,
        s = [];
    return {
        init: function () {
            (e = document.querySelector("#fab_modal_create_account")) &&
                new bootstrap.Modal(e),
                (t = document.querySelector("#fab_create_account_stepper")) &&
                    ((i = t.querySelector("#fab_create_account_form")),
                    (o = t.querySelector('[data-kt-stepper-action="submit"]')),
                    (a = t.querySelector('[data-kt-stepper-action="next"]')),
                    (r = new KTStepper(t)).on(
                        "kt.stepper.changed",
                        function (e) {
                            4 === r.getCurrentStepIndex()
                                ? (o.classList.remove("d-none"),
                                  o.classList.add("d-inline-block"),
                                  a.classList.add("d-none"))
                                : 5 === r.getCurrentStepIndex()
                                ? (o.classList.add("d-none"),
                                  a.classList.add("d-none"))
                                : (o.classList.remove("d-inline-block"),
                                  o.classList.remove("d-none"),
                                  a.classList.remove("d-none"));
                        }
                    ),
                    r.on("kt.stepper.next", function (e) {
                        console.log("stepper.next");
                        var t = s[e.getCurrentStepIndex() - 1];
                        t
                            ? t.validate().then(function (t) {
                                  console.log("validated!"),
                                      "Valid" == t
                                          ? (e.goNext(), KTUtil.scrollTop())
                                          : Swal.fire({
                                                text: "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer.",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "D'accord!",
                                                customClass: {
                                                    confirmButton:
                                                        "btn btn-light",
                                                },
                                            }).then(function () {
                                                KTUtil.scrollTop();
                                            });
                              })
                            : (e.goNext(), KTUtil.scrollTop());
                    }),
                    r.on("kt.stepper.previous", function (e) {
                        console.log("stepper.previous"),
                            e.goPrevious(),
                            KTUtil.scrollTop();
                    }),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                account_type: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account type is required",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                account_team_size: {
                                    validators: {
                                        notEmpty: {
                                            message: "Time size is required",
                                        },
                                    },
                                },
                                account_name: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account name is required",
                                        },
                                    },
                                },
                                account_plan: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account plan is required",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                business_name: {
                                    validators: {
                                        notEmpty: {
                                            message: "Busines name is required",
                                        },
                                    },
                                },
                                business_descriptor: {
                                    validators: {
                                        notEmpty: {
                                            message:
                                                "Busines descriptor is required",
                                        },
                                    },
                                },
                                business_type: {
                                    validators: {
                                        notEmpty: {
                                            message: "Busines type is required",
                                        },
                                    },
                                },
                                business_email: {
                                    validators: {
                                        notEmpty: {
                                            message:
                                                "Busines email is required",
                                        },
                                        emailAddress: {
                                            message:
                                                "The value is not a valid email address",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                card_name: {
                                    validators: {
                                        notEmpty: {
                                            message: "Name on card is required",
                                        },
                                    },
                                },
                                card_number: {
                                    validators: {
                                        notEmpty: {
                                            message: "Card member is required",
                                        },
                                        creditCard: {
                                            message: "Card number is not valid",
                                        },
                                    },
                                },
                                card_expiry_month: {
                                    validators: {
                                        notEmpty: {
                                            message: "Month is required",
                                        },
                                    },
                                },
                                card_expiry_year: {
                                    validators: {
                                        notEmpty: {
                                            message: "Year is required",
                                        },
                                    },
                                },
                                card_cvv: {
                                    validators: {
                                        notEmpty: {
                                            message: "CVV is required",
                                        },
                                        digits: {
                                            message:
                                                "CVV must contain only digits",
                                        },
                                        stringLength: {
                                            min: 3,
                                            max: 4,
                                            message:
                                                "CVV must contain 3 to 4 digits only",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    o.addEventListener("click", function (e) {
                        s[3].validate().then(async function (t) {
                            console.log("validated!"),
                                "Valid" == t
                                    ? (e.preventDefault(),
                                      (o.disabled = !0),
                                      o.setAttribute("data-kt-indicator", "on"),
                                      $("#submitHidden").click())
                                    : Swal.fire({
                                          text: "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer.",
                                          icon: "error",
                                          buttonsStyling: !1,
                                          confirmButtonText: "D'accord!",
                                          customClass: {
                                              confirmButton: "btn btn-light",
                                          },
                                      }).then(function () {
                                          KTUtil.scrollTop();
                                      });
                        });
                    }),
                    $(i.querySelector('[name="card_expiry_month"]')).on(
                        "change",
                        function () {
                            s[3].revalidateField("card_expiry_month");
                        }
                    ),
                    $(i.querySelector('[name="card_expiry_year"]')).on(
                        "change",
                        function () {
                            s[3].revalidateField("card_expiry_year");
                        }
                    ),
                    $(i.querySelector('[name="business_type"]')).on(
                        "change",
                        function () {
                            s[2].revalidateField("business_type");
                        }
                    ));
        },
    };
})();
var KTUpdateAccount = (function () {
    var e,
        t,
        i,
        o,
        a,
        r,
        s = [];
    return {
        init: function () {
            (e = document.querySelector("#fab_modal_update_account")) &&
                new bootstrap.Modal(e),
                (t = document.querySelector("#fab_create_account_stepper")) &&
                    ((i = t.querySelector("#fab_create_account_form")),
                    (o = t.querySelector('[data-kt-stepper-action="submit"]')),
                    (a = t.querySelector('[data-kt-stepper-action="next"]')),
                    (r = new KTStepper(t)).on(
                        "kt.stepper.changed",
                        function (e) {
                            4 === r.getCurrentStepIndex()
                                ? (o.classList.remove("d-none"),
                                  o.classList.add("d-inline-block"),
                                  a.classList.add("d-none"))
                                : 5 === r.getCurrentStepIndex()
                                ? (o.classList.add("d-none"),
                                  a.classList.add("d-none"))
                                : (o.classList.remove("d-inline-block"),
                                  o.classList.remove("d-none"),
                                  a.classList.remove("d-none"));
                        }
                    ),
                    r.on("kt.stepper.next", function (e) {
                        console.log("stepper.next");
                        var t = s[e.getCurrentStepIndex() - 1];
                        t
                            ? t.validate().then(function (t) {
                                  console.log("validated!"),
                                      "Valid" == t
                                          ? (e.goNext(), KTUtil.scrollTop())
                                          : Swal.fire({
                                                text: "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer.",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "D'accord!",
                                                customClass: {
                                                    confirmButton:
                                                        "btn btn-light",
                                                },
                                            }).then(function () {
                                                KTUtil.scrollTop();
                                            });
                              })
                            : (e.goNext(), KTUtil.scrollTop());
                    }),
                    r.on("kt.stepper.previous", function (e) {
                        console.log("stepper.previous"),
                            e.goPrevious(),
                            KTUtil.scrollTop();
                    }),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                account_type: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account type is required",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                account_team_size: {
                                    validators: {
                                        notEmpty: {
                                            message: "Time size is required",
                                        },
                                    },
                                },
                                account_name: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account name is required",
                                        },
                                    },
                                },
                                account_plan: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account plan is required",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                business_name: {
                                    validators: {
                                        notEmpty: {
                                            message: "Busines name is required",
                                        },
                                    },
                                },
                                business_descriptor: {
                                    validators: {
                                        notEmpty: {
                                            message:
                                                "Busines descriptor is required",
                                        },
                                    },
                                },
                                business_type: {
                                    validators: {
                                        notEmpty: {
                                            message: "Busines type is required",
                                        },
                                    },
                                },
                                business_email: {
                                    validators: {
                                        notEmpty: {
                                            message:
                                                "Busines email is required",
                                        },
                                        emailAddress: {
                                            message:
                                                "The value is not a valid email address",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                card_name: {
                                    validators: {
                                        notEmpty: {
                                            message: "Name on card is required",
                                        },
                                    },
                                },
                                card_number: {
                                    validators: {
                                        notEmpty: {
                                            message: "Card member is required",
                                        },
                                        creditCard: {
                                            message: "Card number is not valid",
                                        },
                                    },
                                },
                                card_expiry_month: {
                                    validators: {
                                        notEmpty: {
                                            message: "Month is required",
                                        },
                                    },
                                },
                                card_expiry_year: {
                                    validators: {
                                        notEmpty: {
                                            message: "Year is required",
                                        },
                                    },
                                },
                                card_cvv: {
                                    validators: {
                                        notEmpty: {
                                            message: "CVV is required",
                                        },
                                        digits: {
                                            message:
                                                "CVV must contain only digits",
                                        },
                                        stringLength: {
                                            min: 3,
                                            max: 4,
                                            message:
                                                "CVV must contain 3 to 4 digits only",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    o.addEventListener("click", function (e) {
                        s[3].validate().then(async function (t) {
                            console.log("validated!"),
                                "Valid" == t
                                    ? (e.preventDefault(),
                                      (o.disabled = !0),
                                      o.setAttribute("data-kt-indicator", "on"),
                                      $("#submitHidden").click())
                                    : Swal.fire({
                                          text: "Désolé, il semble que des erreurs aient été détectées, veuillez réessayer.",
                                          icon: "error",
                                          buttonsStyling: !1,
                                          confirmButtonText: "D'accord!",
                                          customClass: {
                                              confirmButton: "btn btn-light",
                                          },
                                      }).then(function () {
                                          KTUtil.scrollTop();
                                      });
                        });
                    }),
                    $(i.querySelector('[name="card_expiry_month"]')).on(
                        "change",
                        function () {
                            s[3].revalidateField("card_expiry_month");
                        }
                    ),
                    $(i.querySelector('[name="card_expiry_year"]')).on(
                        "change",
                        function () {
                            s[3].revalidateField("card_expiry_year");
                        }
                    ),
                    $(i.querySelector('[name="business_type"]')).on(
                        "change",
                        function () {
                            s[2].revalidateField("business_type");
                        }
                    ));
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    try {
        KTCreateAccount.init();
    } catch (error) {}
    try {
        KTUpdateAccount.init();
    } catch (error) {}
});
