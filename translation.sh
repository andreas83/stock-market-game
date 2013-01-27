find . -name "*.php" > potfile.txt
xgettext -f potfile.txt --from-code=UTF-8 --language=PHP -o app/lang/master.pot
