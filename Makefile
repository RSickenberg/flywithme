.DEFAULT_GOAL := help

SCRIPT_AUTHOR=Rsickenberg
SCRIPT_VERSION=1.0.0

# Inspired from: https://gist.github.com/klmr/575726c7e05d8780505a
HELP_FUN = \
    %help; while(<>){push@{$$help{$$2//'options'}},[$$1,$$3] \
    if/^([\w-_]+)\s*:.*\#\#(?:@(\w+))?\s(.*)$$/}; \
    print"$$_:\n", map"  $$_->[0]".(" "x(30-length($$_->[0])))."$$_->[1]\n",\
    @{$$help{$$_}},"\n" for keys %help; \

help: ##@Miscellaneous Show this help.
	@echo "Usage: make [target] ...\n"
	@perl -e '$(HELP_FUN)' $(MAKEFILE_LIST)
	@echo "Written by $(SCRIPT_AUTHOR), version $(SCRIPT_VERSION)"

up: ##@Server Start the server in detached mode.
	@./vendor/bin/sail up -d

down: ##@Server Stop the server
	@./vendor/bin/sail down

pint: ##@Lint Run pint linter
	@./vendor/bin/sail pint

reset_db: ##@DB Wipe and re-migrate / seed
	@./vendor/bin/sail artisan db:wipe
	@./vendor/bin/sail artisan migrate
	@./vendor/bin/sail artisan db:seed
