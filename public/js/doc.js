var exampleid = 0;

function generateDocs(config) {
        function getExample(sample) {
            var li = $('<li/>');
            var currentid = exampleid;
            var textarea = $('<textarea/>', {
                id: "code" + exampleid++,
                class: "expand",
            });
            textarea.css('width', '100%');
            textarea.text(sample);

            
            var button = $('<button/>');
            button.css('margin-bottom', '10px');
            button.html('Run!');
            button.attr('data-code-id', currentid);
            button.on('click', function() {
                var code = $('#code' + button.attr('data-code-id')).val();
                eval(code);
            });
            
            var buttonVisibility = $('<button/>');
            buttonVisibility.html('Toggle code');
            //buttonVisibility.css('float', 'right');
            buttonVisibility.css('margin-bottom', '10px');
            buttonVisibility.css('margin-left', '10px');
            buttonVisibility.attr('data-code-id', currentid);
            buttonVisibility.on('click', function() {
                var code = $('#code' + buttonVisibility.attr('data-code-id'));
                code.toggle();
                code.TextAreaExpander();
            });
            
            li.append(button);
            li.append(buttonVisibility);
            li.append(textarea);
            
            
            return li;
        }
    
	var div = $('<div/>');
	
	var h2 = $('<h2/>');
	h2.html(config.name);
	div.append(h2);
	
	var ul = $('<ul/>');
        
        if(config.fields) {
            ul.append($('<span/>', {
                    class: "fg-darkIndigo",
                    style: "margin-top: 20px;"
            }).html("Fields"));
            var ulFields = $('<ul/>', {
                    style: "margin-bottom: 20px; margin-top: 10px;"
            });
            for(var i = 0; config.fields && i < config.fields.length; ++i) {
                    ulFields.append(
                            $('<li/>')
                            .append(config.fields[i].name + ': ')
                            .append(
                                    $('<span/>', {
                                            class: "fg-darkGreen text-bold"
                                    }).append(config.fields[i].type)
                            ));
            }
            ul.append(ulFields);
        }
        
        if(config.interfaces) {
            ul.append($('<span/>', {
                    class: "fg-darkIndigo",
                    style: "margin-bottom: 20px; margin-top: 10px;"
            }).html("Interfaces"));

            var interfacesFields = $('<ul/>', {
                    style: "margin-top: 10px;"
            });
            for(var i = 0; config.interfaces && i < config.interfaces.length; ++i) {
                    var interface = config.interfaces[i];
                    var parameters = $('<ul/>');
                    if(!interface.parameters || interface.parameters.length === 0) {
                            parameters.append(
                                    $('<li/>').append(
                                            $('<span/>', {
                                                    class: "fg-grayLight"
                                            }).append("no parameters")
                                    )
                            );
                    }
                    for(var j = 0; interface.parameters && j < interface.parameters.length; ++j) {
                            var parameter = interface.parameters[j];
                            parameters.append(
                                $('<li/>')
                                    .append(parameter.name + ': ')
                                    .append(
                                            $('<span/>', {
                                                    class: "fg-darkGreen text-bold"
                                            }).append(parameter.type))
                                    .append(
                                            parameter.optional ?
                                            $('<span/>', {
                                                    class: "fg-gray"
                                            }).append(' - optional')
                                            : ''
                                    ));
                    };
                    interfacesFields
                            .append(
                                    $('<span/>', {
                                                    class: "fg-darkOrange text-bold",
                                                    style: "margin-top: 20px;"
                                            }).append(interface.name))
                            .append(
                                    $('<li/>')
                                    .append(
                                            $('<li/>')
                                                    .append("url: ")
                                                    .append(
                                                            $('<span/>', {
                                                                    class: "fg-blue"
                                                            }).append(interface.url)))
                                                    .append(
                                                            $('<ul/>')
                                                                    .append(interface.example ? getExample(interface.example) : '')
                                                    ))
                                    .append(
                                            $('<li/>', {
                                                    style: "margin-bottom: 20px;"
                                            })
                                            .append("parameters ")
                                            .append(parameters)
                    );
            }
            ul.append(interfacesFields);
        }
	
	div.append(ul);
	$('body').append(div);
        $(document).ready(function(){
            jQuery("textarea[class*=expand]").toggle();
            jQuery("textarea[class*=expand]").TextAreaExpander();
        });
        
        

}
