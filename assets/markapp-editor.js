var schema_markapp_toggle_not_supported,
    schema_markapp_toggle_sidebar,
    schema_markapp_show_schema;

(function($) {
    $(function() {

        let sidebarEl = $('#schema-markapp-sidebar');

        sidebarEl.find('iframe').load(function() {
            let sidebarIframe = this;
            let body = sidebarIframe.contentDocument.body;
            $('.schema-close', body).click(function() {
                sidebarEl.toggle();
                return false;
            });
            $('a.sm-schema-show-fields', body).click(function() {
                $(this).parents('.sm-scheme').find('.sm-scheme-option').toggle();

                return false;
            });

        });

        schema_markapp_toggle_not_supported = function() {
            console.log('Page type is not supported');
        };

        schema_markapp_toggle_sidebar = function() {
            sidebarEl.toggle();
        };


        let filterSchema = function(schema) {

            delete schema["@context"]

            if (schema.hasOwnProperty('@graph') && schema["@graph"].length > 0) {
                let graph = schema["@graph"][0];
                delete graph['@id']
                delete graph['datePublished']
                delete graph['speakable']
                delete graph['isPartOf']
            }

            return schema;
        };

        schema_markapp_show_schema = function() {
            let previewModal = $('#schema-markapp-preview-schema');
            let codeWrap = previewModal.find('.schema-markapp-code-wrap');
            codeWrap.html('');
            $('script[type="application/ld+json"]').each(function() {
                let schema = filterSchema(JSON.parse($(this).html()));
                if (schema.hasOwnProperty('@graph') && schema['@graph'].length > 0) {
                    codeWrap.append('<div class="sm-schema-title">' + schema["@type"] + ' &gt ' + schema["@graph"][0]["@type"] + '</div>');
                }
                else {
                    codeWrap.append('<div class="sm-schema-title">' + schema["@type"] + '</div>');
                }

                codeWrap.append('<div class="sm-json">' + JSON.stringify(schema, null, 4)+ '</div>');
            });

            previewModal.toggle();
        };

        $('#schema-markapp-preview-schema .preview-close').click(function() {
            let previewModal = $('#schema-markapp-preview-schema');
            previewModal.toggle();
        });
    });
})( jQuery );

