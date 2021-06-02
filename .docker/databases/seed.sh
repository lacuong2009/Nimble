#!/usr/bin/env bash
psql -U $POSTGRES_USER -f /seeds/seed-data.sql
