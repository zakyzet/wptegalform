var $ = jQuery.noConflict()
$(document).ready(function() {
    $.fn.stickyInParent = function() {
        return this.each(function() {
            var $element = $(this);
            var $parent = $element.closest('[data-parent]');
            var parentTop = $parent.offset().top;
            var parentBottom = parentTop + $parent.innerHeight();
            var elementHeight = $element.outerHeight();
            var originalPosition = $element.offset().top;

            $(window).on('scroll', function() {
                var scrollY = window.scrollY;

                if (scrollY > parentTop && scrollY + elementHeight <= parentBottom) {
                    $element.css({
                        top: scrollY - 37
                    })
                } else if (scrollY < parentTop) {
                    $element.css({
                        top: originalPosition - parentTop + 'px',
                    });
                } else if (scrollY + elementHeight > parentBottom) {
                    $element.css({
                        top: parentBottom - parentTop - elementHeight + 'px',
                    })
                }
            });
        });
    };

    function init() {
        $('.select').each(function() {
            var select = $(this),
                size = (select.data('size') !== undefined) ? select.data('size') : 4;
            select.selectpicker({
                style: 'select-control',
                placeholder: 'halo',
                size: size,
                liveSearchPlaceholder: 'Search here..',
                width: "100%",
            });
            select.each(function() {
                if (select.attr('multiple')) {
                    select.on('changed.bs.select loaded.bs.select', function(e, clickedIndex, isSelected, previousValue) {
                        var $title = $(this).parent().find('.filter-option-inner-inner');
                        var selectedText = $title.text();
                        var $rootEl = $(this).parent();

                        if ($(this).parent().find('.bs-placeholder').length === 0) {

                            var selectedCount = selectedText.split(', ').length;
                            if (selectedCount > 2) {
                                selectedText = selectedCount;
                            }
                            $title.text($(this).attr('title'));
                            $rootEl.addClass('has-selected');
                        } else {
                            $title.text($(this).data('placeholder'));
                            $rootEl.removeClass('has-selected');
                        }
                    });
                }
            })

        });
        // INLINE SVG
        jQuery('img.svg').each(function(i) {
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                var $svg = jQuery(data).find('svg');
                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                $img.replaceWith($svg);
            }, 'xml');
        });
    }
    init(); // end of init()

    function func() {
        var ww = $(window).width();

        var header = jQuery('.header'),
            pos = header.outerHeight();

        var lastScroll = 0;
        jQuery(window).scroll(function() {
            var scroll = jQuery(window).scrollTop();
            if (scroll > 5) {
                header.addClass('fixed');
            } else {
                header.removeClass('fixed');
            }
            if (scroll > lastScroll) {
                header.removeClass('show-top');
            } else {
                header.addClass('show-top');
            }
            lastScroll = scroll;
        });

        jQuery('.header .burger').click(function() {
            var t = $(this);
            jQuery('body').toggleClass('menu-open');
        });

        $('.navmain .nav-item.has-sub').each(function() {
            var t = $(this),
                mm = t.find('.megamenu');
            if (mm.length > 0) {
                if (ww > 1100) {
                    t.on("mouseover", function() {
                        header.addClass('megamenuShow')
                        t.addClass('mmActive')
                    });
                    t.on("mouseout", function() {
                        header.removeClass('megamenuShow')
                        t.removeClass('mmActive')
                    });
                } else {
                    t.on('click', function() {
                        header.toggleClass('megamenuShow')
                        t.toggleClass('mmActive')
                    })
                }
            } else {
                if (ww < 1100) {
                    t.on('click', function() {
                        header.toggleClass('submenuShow')
                    })
                }
            }
        })

        $('.swiper').each(function() {
            var t = $(this);
            var child = t.find('.swiper-slide').length;
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                direction: 'horizontal',
                loop: false,
                slidesPerView: 3,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    // when window width is >= 640px
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                on: {
                    init: function() {
                        var activeIndex = this.activeIndex + 3;
                        t.siblings('.swiper-navigation').find('.pgrogressbar span').css('width', activeIndex / child * 100 + '%');
                    },
                    slideChange: function() {
                        var activeIndex = this.activeIndex + 3;
                        console.log('Slide index:', activeIndex);
                        console.log('Slide total:', totalItems);
                        t.siblings('.swiper-navigation').find('.pgrogressbar span').css('width', activeIndex / totalItems * 100 + '%');
                    }
                }
            });

            function getTotalItems() {
                var totalItems = swiper.slides.length;
                return totalItems;
            }
            var totalItems = getTotalItems();
            var totalItemss = getTotalItems();
            if (child <= 3) {
                t.addClass('no-swiper')
            }
        })

        $('.tcm-mq').each(function() {
            var t = $(this),
                cw = t.find('.js-marquee-wrapper').width(),
                mqw = t.width();
            t.css({ left: cw });

            var baseDuration = 20000; // Base duration for a standard width
            var standardWidth = ww; // Assume a standard window width
            var dynamicDuration = baseDuration * (mqw / standardWidth);

            console.log(dynamicDuration)

            t.marquee({
                duration: dynamicDuration,
                gap: 0,
                duplicated: true
            })


        })

        $('.tcm-mq-reverse').each(function() {
            var t = $(this),
                cw = t.find('.js-marquee-wrapper').width(),
                mqw = t.width();
            t.css({ left: cw });

            var baseDuration = 30000; // Base duration for a standard width
            var standardWidth = ww; // Assume a standard window width
            var dynamicDuration = baseDuration * (mqw / standardWidth);

            console.log(dynamicDuration)

            t.marquee({
                duration: dynamicDuration,
                gap: 0,
                duplicated: true,
                direction: 'right',
                startVisible: true
            })
        })

        $('.homepage-care').each(function() {
            var t = $(this),
                cover = t.find('.homepage-care-cover'),
                aksen = t.find('.homepage-care-aksen'),
                p = t.find('.homepage-care-category > ul > li');

            p.each(function() {
                $(this).click(function() {
                    var daksen = $(this).data('aksen');
                    t.toggleClass('active')
                    p.removeClass('acitve').not(this).toggleClass('hide')
                    $(this).toggleClass('active')
                    cover.toggleClass('hidden')
                    aksen.toggleClass('show')
                    aksen.attr('src', daksen)
                })
            })


            $('.menu-mobile').each(function() {
                $(this).on("click", function() {
                    if ($(window).width() <= 767) {
                        $(this).toggleClass("expand")
                    }
                })
            })

        })

        $('.herbs_sc2_col').each(function() {
            var init = false;
            var sc2Swiper;
            var t = $(this)

            function swiperCard() {
                if (window.innerWidth < 768) {
                    if (!init) {
                        t.addClass("swiper")
                        t.wrapInner("<div class='swiper-wrapper' />")
                        t.find(".herbs_sc2_item").addClass("swiper-slide")
                        t.append("<div class='swiper-pagination' />")
                        init = true;
                        sc2Swiper = new Swiper(".herbs_sc2_col", {
                            direction: "horizontal",
                            slidesPerView: 1,
                            centeredSlides: true,
                            autoHeight: true,
                            spaceBetween: 32,
                            pagination: {
                                el: '.swiper-pagination',
                            },
                        });
                    }
                } else if (init) {
                    t.removeClass("swiper")
                    t.find(".swiper-wrapper").contents().unwrap();
                    t.find(".swiper-pagination").remove();
                    t.find(".herbs_sc2_item").removeClass("swiper-slide")
                    sc2Swiper.destroy();
                    init = false;
                }
            }
            swiperCard();
            window.addEventListener("resize", swiperCard);
        })

        $('.spotlight-logos').each(function() {
            var init = false;
            var sl2Swiper;
            var t = $(this)

            function swiperCard() {
                if (window.innerWidth < 768) {
                    if (!init) {
                        t.addClass("swiper")
                        t.wrapInner("<div class='swiper-wrapper' />")
                        t.find(".col-lg-3").addClass("swiper-slide")
                        t.append("<div class='swiper-pagination' />")
                        init = true;
                        sl2Swiper = new Swiper(".spotlight-logos", {
                            direction: "horizontal",
                            slidesPerView: 1,
                            centeredSlides: true,
                            autoHeight: true,
                            spaceBetween: 32,
                            pagination: {
                                el: '.swiper-pagination',
                            },
                        });
                    }
                } else if (init) {
                    t.removeClass("swiper")
                    t.find(".swiper-wrapper").contents().unwrap();
                    t.find(".swiper-pagination").remove();
                    t.find(".herbs_sc2_item").removeClass("swiper-slide")
                    sl2Swiper.destroy();
                    init = false;
                }
            }
            swiperCard();
            window.addEventListener("resize", swiperCard);
        })

        $('.section-fullvideo').each(function() {
            var t = $(this),
                btn = t.find('.btn-play');

            btn.click(function() {
                setTimeout(
                    function() {
                        $('body').find('.lity').addClass('fullVideo')
                    }, 100);
            })

        })

        const defaultFormData = '';

        const fbOptions = {
            onSave: function() {
                $fbEditor.toggle();

                // Update the form with ID 'preview' using formRender
                $('#preview').formRender({
                    formData: formBuilder.formData
                });

                // Update the textarea with ID 'post_content' in the form with ID 'submission'
                $('#form_content').val(formBuilder.formData);


                console.log('Form Data:', formBuilder.formData);

                // Hide "Save form" button and show "#editData" button
                $('#fb-editor-action').hide();
                $formPreview.show();
                $formContainer.addClass('box-preview');
            }
        };

        var options = {
            controlPosition: 'right',
            controlOrder: [
                'header',
                'paragraph',
                'text',
                'textarea',
                'select',
                'checkbox-group',
                'radio-group',
                'date',
                'hidden',
            ],

            disableFields: [
                'autocomplete',
                'file',
                'button',
                'number'
            ],

            disabledAttrs: [
                'access',
                'className',
                'inline',
                'max',
                'maxlength',
                'min',
                'name',
                'placeholder',
                'step',
                'style',
                'subtype',
                'toggle',
            ],

            subtypes: {
                text: ['number']
            },

            disabledSubtypes: {
                text: ['password'],
            },

            typeUserDisabledAttrs: {
                'radio-group': [
                    'other'
                ]
            },

            scrollToFieldOnAdd: true,
            showActionButtons: false,
            // Include default form data here
            formData: defaultFormData,
            ...fbOptions
            // onRender: function() {

            // },
            // onRender: function() {
            //     // Memindahkan list elemen form ke lokasi yang diinginkan setelah render

            //     $('#build-wrap .cb-wrap sticky-controls').appendTo('#custom-control-list');
            //     console.log('a')
            // }

        };
        $('#fb-editor').formBuilder(options);
        setTimeout(function() {
            var listform = $('body').find('.form-builder .cb-wrap.sticky-controls');
            var dragarea = $('body').find('.form-builder.formbuilder-embedded-bootstrap');
            $('#custom-control-list').append(listform);
            $('#my-drop-area').append(dragarea);
        }, 350);

        // 
        // $('#custom-control-list').html($('.cb-wrap.sticky-controls').detach());
        $('.copyiframe').click(function() {
            // Ambil elemen input
            var inputElement = $('this').find('.form-control');
            inputElement.removeAttr('disabled')

            // Pilih teks di dalam input
            // inputElement.select();
            console.log(inputElement)

            // Gunakan Clipboard API untuk menyalin teks ke clipboard
            navigator.clipboard.writeText(inputElement).then(function() {
                // Tampilkan pesan sukses jika berhasil disalin
                $('#result').text('Text copied: ' + textToCopy);
            }).catch(function(err) {
                // Tampilkan pesan error jika terjadi kesalahan
                $('#result').text('Failed to copy text: ' + err);
            });

            // Salin teks ke clipboard
            // document.execCommand('copy');

        });

    }
    func();


});