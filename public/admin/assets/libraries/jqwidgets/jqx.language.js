var CUSTOMLANGUAGEVN = {
    // separator of parts of a date (e.g. '/' in 11/05/1955)
    '/': "/",
    // separator of parts of a time (e.g. ':' in 05:44 PM)
    ':': ":",
    // the first day of the week (0 = Sunday, 1 = Monday, etc)
    firstDay: 0,
    days: {
        // full day names
        names: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
        // abbreviated day names
        namesAbbr: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
        // shortest day names
        namesShort: ["Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"]
    },
    months: {
        // full month names (13 months for lunar calendards -- 13th month should be "" if not lunar)
        names: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12", ""],
        // abbreviated month names
        namesAbbr: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12", ""]
    },
    // AM and PM designators in one of these forms:
    // The usual view, and the upper and lower case versions
    //      [standard,lowercase,uppercase]
    // The culture does not use AM or PM (likely all standard date formats use 24 hour time)
    //      null
    AM: ["Sáng", "sáng", "SÁNG"],
    PM: ["Chiều", "chiều", "chiều"],
    eras: [
    // eras in reverse chronological order.
    // name: the name of the era in this culture (e.g. A.D., C.E.)
    // start: when the era starts in ticks (gregorian, gmt), null if it is the earliest supported era.
    // offset: offset in years from gregorian calendar
    {"name": "A.D.", "start": null, "offset": 0 }
],
    twoDigitYearMax: 2029,
    patterns: {
        // short date pattern
        d: "M/d/yyyy",
        // long date pattern
        D: "dddd, MMMM dd, yyyy",
        // short time pattern
        t: "h:mm tt",
        // long time pattern
        T: "h:mm:ss tt",
        // long date, short time pattern
        f: "dddd, MMMM dd, yyyy h:mm tt",
        // long date, long time pattern
        F: "dddd, MMMM dd, yyyy h:mm:ss tt",
        // month/day pattern
        M: "MMMM dd",
        // month/year pattern
        Y: "yyyy MMMM",
        // S is a sortable format that does not vary by culture
        S: "yyyy\u0027-\u0027MM\u0027-\u0027dd\u0027T\u0027HH\u0027:\u0027mm\u0027:\u0027ss"
    },
    percentsymbol: "%",
    currencysymbol: "$",
    currencysymbolposition: "before",
    decimalseparator: '.',
    thousandsseparator: ',',
    pagergotopagestring: "Đi đến trang:",
    pagershowrowsstring: "Hiện số dòng:",
    pagerrangestring: " của ",
    pagerpreviousbuttonstring: "Trang trước",
    pagernextbuttonstring: "Trang tiếp theo",
    groupsheaderstring: "Drag a column and drop it here to group by that column",
    sortascendingstring: "Sắp xếp tăng dần",
    sortdescendingstring: "Sắp xếp giảm dần",
    sortremovestring: "Hủy bỏ",
    groupbystring: "Group By this column",
    groupremovestring: "Remove from groups",
    filterclearstring: "Hủy",
    filterstring: "Lọc",
    filtershowrowstring: "Show rows where:",
    filterorconditionstring: "Or",
    filterandconditionstring: "And",
    filterselectallstring: "(Select All)",
    filterchoosestring: "Vui lòng chọn:",
    filterstringcomparisonoperators: ['rỗng', 'không rỗng', 'gần giống', 'khớp(chính xác)',
        'không giống', 'không(chính xác)', 'bắt đầu với', 'bắt đầu(chính xác)',
        'kết thúc với', 'kết thúc(chính xác)', 'giống', 'giống chính xác', 'NULL', 'không NULL'],
    filternumericcomparisonoperators: ['bằng', 'không bằng', 'nhỏ hơn', 'nhỏ hơn hoặc bằng', 'lớn hơn', 'lớn hơn hoặc bằng', 'Null', 'không Null'],
    filterdatecomparisonoperators: ['bằng', 'không bằng', 'nhỏ hơn', 'nhỏ hơn hoặc bằng', 'lớn hơn', 'lớn hơn hoặc bằng', 'Null', 'không Null'],
    filterbooleancomparisonoperators: ['bằng', 'không bằng'],
    validationstring: "Dữ liệu nhập không hợp lệ",
    emptydatastring: "Không có dữ liệu",
    filterselectstring: "Vui lòng chọn",
    loadtext: "Đang tải...",
    clearstring: "Xóa",
    todaystring: "Hôm nay"          
};
          