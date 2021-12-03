import csv
from datetime import datetime
import requests
from bs4 import BeautifulSoup

def get_url(position, location):
  """Generate a url from position and location"""
  template = 'https://www.simplyhired.com/search?q=cannabis{}&1={}'
  url = template.format(position, location)
  return url

url = get_url('cannabis', '')

response = requests.get(url)

response

response.reason
'OK'

soup = BeautifulSoup(response.text, 'html.parser')

cards = soup.find_all('div', 'SerpJob-jobCard card isp')


card = cards[0]
atag = card.h3.a
job_title = atag.get('jobposting-title')
job_url = 'https://www.simplyhired.com' + atag.get('href')
company = card.find('span', 'JobPosting-labelWithIcon jobposting-company').text.strip()
job_location = card.find('span', 'jobposting-location').get('data-rc-loc')
job_summary = card.find('div', 'SerpJob-snippetContainer').text.strip()
try:
  job_salary = card.find('div', 'jobposting-salary SerpJob-salary').text.strip()
except AttributeError:
  job_salary = ''

def get_record(card):
  """Extract job data from a single record"""
  atag = card.h3.a
  job_title = atag.get('jobposting-title')
  job_url = 'https://www.simplyhired.com' + atag.get('href')
  company = card.find('span', 'JobPosting-labelWithIcon jobposting-company').text.strip()
  job_location = card.find('span', 'jobposting-location').get('data-rc-loc')
  job_summary = card.find('div', 'SerpJob-snippetContainer').text.strip()
  try:
    job_salary = card.find('div', 'jobposting-salary SerpJob-salary').text.strip()
  except AttributeError:
    job_salary = ''

  record = (job_title, company, job_location, job_summary, job_salary, job_url)

  return record

records = []

for card in cards:
  record = get_record(card)
  records.append(record)

"""Getting the next page"""
while True:
  try:
    url = 'https://www.simplyhired.com' + soup.find('a', {'aria-label': 'Next page'}).get('href')
  except AttributeError:
    break

  response = requests.get(url)
  soup = BeautifulSoup(response.text, 'html.parser')
  cards = soup.find_all('div', 'SerpJob-jobCard card isp')

  for card in cards:
    record = get_record(card)
    records.append(record)


#Putting it all together

import csv
from datetime import datetime
import requests
from bs4 import BeautifulSoup

def get_url(position, location):
  # Generate a url from position and location
  template = 'https://www.simplyhired.com/search?q=cannabis'
  url = template.format(position, location)
  return 
  
def get_record(card):
  # Extract job data from a single record
  atag = card.h3.a
  job_title = atag.get('jobposting-title')
  job_url = 'https://www.simplyhired.com' + atag.get('href')
  company = card.find('span', 'JobPosting-labelWithIcon jobposting-company').text.strip()
  job_location = card.find('span', 'jobposting-location').get('data-rc-loc')
  job_summary = card.find('div', 'SerpJob-snippetContainer').text.strip()
  try:
    job_salary = card.find('div', 'jobposting-salary SerpJob-salary').text.strip()
  except AttributeError:
    job_salary = ''

  record = (job_title, company, job_location, job_summary, job_salary, job_url)

  return record
  
def main(position, location):
  # Run the main program routine
  records = []
  url = get_url(position, location)

  while True:
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')
    cards = soup.find_all('div', 'SerpJob-jobCard card isp')

    for card in cards:
      record = get_record(card)
      records.append(record)
  
    try:
      url = 'https://www.simplyhired.com' + soup.find('a', {'aria-label': 'Next page'}).get('href')
    except AttributeError:
      break

  # Save the job data
  with open('results.csv', 'w', newline='', encoding='utf-8') as f:
    writer = csv.writer(f)
    writer.writerow(['JobTitle', 'Company', 'Location', 'Summary', 'Salary', 'JobUrl'])
    writer.writerows(records)

# Run the main program
main('cannabis', 'Orlando, FL')    
