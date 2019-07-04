#!/bin/bash

# Gera um arquivo com números randomicos em cada linha

for i in {1..500000}; do echo $RANDOM >> file; done