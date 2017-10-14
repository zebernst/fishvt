#!/usr/bin/env python

import requests
import json
from pprint import pprint
import math
import sys

def calculate_distance(lat1, lon1, lat2, lon2):
	# return math.sqrt(math.pow(user_lat - feature_lat, 2) + math.pow(user_lon - feature_lon, 2))

	R = 6371 # radius of the earth in km
	dLat = deg_to_rad(lat2 - lat1)
	dLon = deg_to_rad(lon2 - lon1)
	a = (
	     math.sin(dLat/2) * math.sin(dLat/2) +
	     math.cos(deg_to_rad(lat1)) * math.cos(deg_to_rad(lat2)) *
	     math.sin(dLon/2) * math.sin(dLon/2)
	     )
	c = 2 * math.atan2(math.sqrt(a), math.sqrt(1-a))
	d = R * c # distance in km
	return d

def deg_to_rad(deg):
	return deg * (math.pi / 180.0) 


# handle lat/lon args
has_user_location = False
if len(sys.argv) == 3:
	has_user_location = True
	user_lat = float(sys.argv[1])
	user_lon = float(sys.argv[2])

# fetch data
r = requests.get('https://anrmaps.vermont.gov/arcgis/rest/services/Open_Data/OPENDATA_ANR_TOURISM_SP_NOCACHE_v2/MapServer/163/query?where=1%3D1&outFields=*&outSR=4326&f=json')
data = r.json()['features']


# manipulate data
for entry in data:
	# add distnace to user
	if has_user_location:
		feature_lat = float(entry['geometry'].get('y'))
		feature_lon = float(entry['geometry'].get('x'))
		dist_km = calculate_distance(feature_lat, feature_lon, user_lat, user_lon)
		dist_deg = math.sqrt(math.pow(user_lat - feature_lat, 2) + math.pow(user_lon - feature_lon, 2)) # distance formula
		# print("dist:", dist)
		entry.update(distance={'km': dist_km, 'deg': dist_deg})

	# sanitize 'No' and 'Yes' values
	for key, value in entry['attributes'].items():
		# print(key, "=", value)
		if value == 'No':
			entry['attributes'][key]=False
		elif value == 'Yes':
			entry['attributes'][key]=True


# pprint(data)

# return json string to php
json_string = json.dumps(data)
print(json_string)
