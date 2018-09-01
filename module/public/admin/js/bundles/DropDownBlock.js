DropDownBlock = {

    htmlElementClass: '',

    event: '',

    dropDownElementClass: '',

    init: function (htmlElementClass, event, dropDownElementClass)
    {
        var self = this;
        self.htmlElementClass = htmlElementClass;
        self.event = event;
        self.dropDownElementClass = dropDownElementClass;

        self.openCloseDropDownElement();
    },

    openCloseDropDownElement: function()
    {
        var self = this;
        var htmlElementSelect = '.'+self.htmlElementClass;
        var event = self.event;
        var dropDownElementSelect = self.dropDownElementClass;

        $(htmlElementClass).event(function () {
            var isHidden = $(dropDownElementSelect).hasClass('is--hidden');

            if(isHidden){
                $(dropDownElementSelect).addClass('is--hidden');
            } else {
                $(dropDownElementSelect).removeClass('is--hidden');
            }
        });
    },
};