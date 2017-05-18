#!/bin/bash
echo "Content-type: text/html"
echo ""
decoded=$(printf '%b' "${QUERY_STRING//%/\\x}")
echo "<html><body>$decoded</body><html>"

# Check the login

# Call buff3r-ov3rfl0w with password
