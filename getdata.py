#!/usr/bin/env python

import requests
import json

r = requests.get('https://anrmaps.vermont.gov/arcgis/rest/services/Open_Data/OPENDATA_ANR_TOURISM_SP_NOCACHE_v2/MapServer/163/query?where=1%3D1&outFields=*&outSR=4326&f=json')
data = r.json()['features']

# pprint(data)

json_string = json.dumps(data)
print(json_string)
