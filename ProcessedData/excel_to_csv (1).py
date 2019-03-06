import pandas as pd
data_xls = pd.read_excel('UOS1.xlsx', 'Sheet1', index_col=None)
data_xls.to_csv('UIS.csv', encoding='utf-8',index=False)
