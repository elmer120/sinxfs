/**
 * crea tabella con tabulator.js 
 * @param columns_config configurazione colonne
 */
window.create_table = function create_table(columns_config) {
    //definisco la tabella
    table = new Tabulator("#table", {
        layout: "fitColumns", //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
        responsiveLayout: "collapse", //le colonne si impilano quando non c'è abb spazio
        placeholder: "No Data Available", //quando non ci sono dati
        pagination: "local", //imposto la paginazione
        paginationSize: 20, //per ogni pagina mostro n righe
        selectable: 1, //righe selezionabili
        rowSelected: window.rowSelected, //callback riga selezionata
        rowDeselected: window.row_deselected, //callback riga deselezionata
        rowSelectionChanged: window.row_selection_changed, //callback al cambio selezione riga
        rowDblClick: window.row_dbl_click, //callback al doppio click sulla riga
        tooltips: true,
        columnVertAlign: "bottom",
        columns: columns_config,
    });
}
/** carica i dati in tabella con ajax
 * @param  {} url url ajax
 * @param  {} token token laravel
 * @param  {} obj_parameters parametri ajax
 */
window.load_table = function load_table(url, token, obj_parameters = null) {
    //carico i dati in tabella via ajax
    var ajaxConfig = {
        method: "POST", //set request type to Position
        headers: {
            'X-CSRF-Token': token,
        },
    };
    //console.info(obj_parameters);
    table.setData(url, obj_parameters, ajaxConfig);
}

//per popolare il form
window.get_element = function get_element(id,solaLettura)
{
    //recupero i dati la riga corretta
    data_row = table.searchRows("id", "=", id)[0].getData();
    //per ogni controllo input,select e textare all'interno del form
    let ctrls = $(':input,select,textarea', $('#form'));
    $.each(ctrls,function(index,ctrl){
        
        //c'è il name come key all'interno della riga
        if(data_row.hasOwnProperty(ctrl.name))
        {
            let value = data_row[ctrl.name];
            //console.log($(ctrl).prop("type"));
            //guardo il tipo
            switch(ctrl.type) {
                case "select-one": //definire i select con gli attributi name="chiave della tabella" e data-url="url ajax da chiamare"
                        //popolo i select 
                        let elemento = ctrl;
                        //valore dell'attributo data-url del select come url da chiamare 
                        let url = elemento.dataset.url;
                        value = data_row["id_"+ctrl.name];
                        let valoreSelezionato = value;
                        let datiDaInviare = null
                        switch(ctrl.name){
                            case "comune_nascita":
                                 datiDaInviare = {"provincia_select" : ($('[name="provincia_nascita"]')[0].value)};
                            break;
                            case "comune_residenza":
                                datiDaInviare = {"provincia_select" : ($('[name="provincia_residenza"]')[0].value)};
                            break;
                        }
                        get_options(elemento,url,valoreSelezionato,datiDaInviare);
                    break;
                case "select-multiple":
                    console.log("select-multiple non implementato!");
                    break;
                case "date":
                    //converto la data nel formato accettato dal ctrl
                    //se la data non è valida
                    if(!moment(value,'YYYY-MM-DD',true).isValid())
                    {
                        
                    }
                    ctrl.value = (moment(value).format('YYYY-MM-DD'));
                    
                    break;
                case "radio": case "checkbox":   
                    //ctrl.each(function() {
                        if($(ctrl).prop("checked") != value) 
                            { 
                                $(ctrl).prop("checked",value); 
                                //forzo l'evento change sul checkbox
                                $(ctrl).trigger("change");    
                            }
                   // });   
                    break; 
                case "text": 
                    ctrl.value = value;
                    break; 
                case "email": 
                    ctrl.value = value;
                    break; 
            }
        }else{//non c'è il name come key nella riga
             console.log("Attenzione il control: "+ctrl.tagName+" con attributo name: "+ctrl.name+" non è mappato nella tabella");
        return;
            
        }
    });
}

/*chiamata ajax per popolare i select con le options
 * @param {string}||{object} id select o elemento
 * @param {string} url ajax
 * @param {int} id da selezionare
 * @param {string} data dati da inviare
 */
window.get_options = function get_options(elemento, url,valoreSelezionato = null,datiDaInviare = null) {
    if (typeof (elemento) === "object") {
        if (elemento.length) {
            //TODO SERVE??
            var valoreSel = null;
            valoreSel = valoreSelezionato;
            $.ajax({
                async: false,
                url: url,
                data: datiDaInviare,
                success: function (data) {
					/*imposto placeholder*/
					let label_text = $(elemento).prev().text();
                    $(elemento).html('<option value="" disabled selected>' + label_text + '</option>');
					/*ciclo l'array ritornato*/
					for (let i = 0; i < data.length; i++) {
						let id = "";
						let field1 = "";
						let field2 = "";
						let fields = Object.values(data[i]);
						id = fields[0];
						field1 = fields[1];
						field2 = (fields[2] != undefined) ? "-"+fields[2]:"";
						/*creo il tag <option></option>*/
						var option = "<option value='" + id + "'>" + field1 + field2 + "</option>";
						/*lo aggiungo al tag <select></select>*/
						$(elemento).append(option);
					}
					if(valoreSelezionato!= undefined && valoreSelezionato != null)
					{	//seleziono l'elemento corretto
						elemento.value = valoreSelezionato;
					}
                },
                error: function (data) {
                    alert("get_options: Errore nella chiamata ajax!" + data);
                }
            });
        } else {
            alert("L'id " + id_element + " non esiste.")
        }
	}
	else {alert("get_options: Tipo elemento errato "+typeof(elemento))}
}

/** 
 * Ricerca una stringa nella tabella 
 * @param {string} str da ricercare
 */
window.search = function search(str) {
    var filters = [];
    var columns = table.getColumns();
    var search = str;

    columns.forEach(function (column) {
        if (column.getField() != undefined) {
            filters.push({
                field: column.getField(),
                type: "like",
                value: search,
            });
        }
    });

    table.setFilter([filters]);
}
/**
 * reset form
 * @return {null} nothing
 */
window.form_reset = function form_reset() {
    //pulisco gli input del form
    $("#form")[0].reset();
    //rimuovo gli eventuali campi nascosti degli id
    $('input[type=hidden]').remove()
    //rimuovo i danger
    $(":input").removeClass('uk-form-danger');
    //riabilito il btn submit
    $('#btn_submit').attr('disabled', false);
    console.log('Reset form ok');
}
/**
 * reset form
 * @return {null} nothing
 */
window.form_read_only = function form_read_only(setta) {

    $('#form *').prop('readonly', setta);
    //riabilito il btn submit
    $('#btn_submit').prop('disabled', setta);
    console.info('Form in sola lettura: ' + setta);
}

/**
 * @param  {boolean} state true per disabilitare
 */
window.btn_disable = function btn_disable(state) {
    //disabilito i pulsanti
    $('#btn_modifica').attr('disabled', state);
    $('#btn_elimina').attr('disabled', state);
    $('#btn_visualizza').attr('disabled', state);
    $('#btn_stampa').attr('disabled', state);
}


/** chiamata ajax per popolare gli input
 * @param {string} attributo name input
 * @param {url} url ajax
 */
window.get_input_value = function get_input_value(name_input, url) {
    if ($('input[name="' + name_input + '"]').length) {
        $.ajax({
            url: url,
            data: '',
            success: function (data) {
                $('input[name="' + name_input + '"]')[0].value = data;
                $('#modal_loading').toggleClass('uk-hidden', true);
            },
            error: function (data) {
                alert("get_options: Errore nella chiamata ajax!" + data);
            }
        });
    } else {
        alert("L'input con name= " + name_input + " non esiste.")
    }

}

/** alla selezione di un riga
 *  @param {object} riga
 */
window.rowSelected = function row_selected(row) {
    //recupero l'id (del database)
    row_selected_id = row.getData()['id'];
    if (row_selected_id != null) { //abilito i pulsanti
        btn_disable(false);
    }
};
/** alla deselezione di un riga
 *  @param {object} riga
 */
window.row_deselected = function row_deselected(row) {
    row_selected_id = null;
    //disabilito i pulsanti
    btn_disable(true);
}
/** al cambio selezione di un riga
 *  @param {object} data
 * @param {object} riga
 */
window.row_selection_changed = function row_selection_changed(data, rows) {
    if (data.length > 0) {
        row_selected_id = data[0].id;
        btn_disable(false);
    }
}
/** al doppio click sulla riga 
 *  @param {object} data
 * @param {object} riga
 */
window.row_dbl_click = function row_dbl_click(e, row) {

    //recupero l'id (del database)
    row_selected_id = row.getData()['id'];
    if (row_selected_id != null && row_selected_id > 0) {
        $("#btn_visualizza").trigger("click");
        UIkit.modal($("#modal")[0]).show();
    }
}


/** chiamata ajax per rimuovere un elemento
 *  @param {Number} id id del database
 *  @param {String} url url su cui effettuare la chiamata
 */
window.remove = function remove(id, url) {
    $.ajax({
        url: url,
        method: "DELETE",
        data: {
            "id": id
        },
        success: function (data) {
            //stampo messaggio 
            UIkit.notification({
                message: data,
                status: '',
                pos: 'bottom-center',
                timeout: 3000
            });
            //chiudo il modal
            setTimeout(() => {
                UIkit.modal($('#modal')).hide();
                table.setData();
            }, 2000);
        },
        error: function (data) {
            alert('Remove: Errore chiamata ajax!');
        }
    });
}
/** funzione per rimuovere i valori null nella generazione del pdf
 * 
 */
window.notNull = function (value, data, type, params, column) {
    return (value == null) ? "" : value;
};
