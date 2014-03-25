function generateDocs(config) {
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
                                                                    .append(
                                                                            interface.example ?
                                                                            $('<li/>')
                                                                            .append(
                                                                                    $('<span/>', {
                                                                                            class: "fg-grayLight"
                                                                                    }).append(interface.example)) : '')
                                                                    .append(
                                                                            interface.example ? 
                                                                            $('<li/>')
                                                                            .append(

                                                                                    $('<button>', {
                                                                                            onclick: interface.example
                                                                                    }).append(interface.name)) : '')
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
}
