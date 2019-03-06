import openpyxl
excel_document=openpyxl.load_workbook('OriginalUOS1.xlsx')
print(excel_document.get_sheet_names())