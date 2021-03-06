import React from 'react';
import PropTypes from 'prop-types';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import Typography from '@material-ui/core/Typography';
import InputBase from '@material-ui/core/InputBase';
import { fade } from '@material-ui/core/styles/colorManipulator';
import { withStyles } from '@material-ui/core/styles';
import MenuIcon from '@material-ui/icons/Menu';
import SearchIcon from '@material-ui/icons/Search';
import { connect } from "react-redux";

const styles = theme => ({
  root: {
    width: '100%',
  },
  grow: {
    flexGrow: 1,
  },
  menuButton: {
    marginLeft: -12,
    marginRight: 20,
  },
  title: {
    display: 'none',
    [theme.breakpoints.up('sm')]: {
      display: 'block',
    },
  },
  search: {
    position: 'relative',
    borderRadius: theme.shape.borderRadius,
    backgroundColor: fade(theme.palette.common.white, 0.15),
    '&:hover': {
      backgroundColor: fade(theme.palette.common.white, 0.25),
    },
    marginLeft: 0,
    width: '100%',
    [theme.breakpoints.up('sm')]: {
      marginLeft: theme.spacing.unit,
      width: 'auto',
    },
  },
  searchIcon: {
    width: theme.spacing.unit * 9,
    height: '100%',
    position: 'absolute',
    pointerEvents: 'none',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  },
  inputRoot: {
    color: 'inherit',
    width: '100%',
  },
  inputInput: {
    paddingTop: theme.spacing.unit,
    paddingRight: theme.spacing.unit,
    paddingBottom: theme.spacing.unit,
    paddingLeft: theme.spacing.unit * 10,
    transition: theme.transitions.create('width'),
    width: '100%',
    [theme.breakpoints.up('sm')]: {
      width: 120,
      '&:focus': {
        width: 200,
      },
    },
  },
});

function NavigationBar (props) {
  const { classes } = props;
  return (
    <div className={classes.root}>
      <AppBar position="static">
        <Toolbar style={{background:'#030203'}}>
          <Typography className={classes.title} variant="h6" color="inherit" noWrap>
            {props.username}
          </Typography>
          <div className={classes.grow} />
          <div className={classes.search} style={{ display: props.displaySearchFields }}>
            <div className={classes.searchIcon}>
              <SearchIcon />
            </div>
            <InputBase
              placeholder="Search content..."
              classes={{
                root: classes.inputRoot,
                input: classes.inputInput
              }}
              id="searchContent"
              onKeyPress={props.onSearchSubmit}
            />
          </div>
          <div className={classes.search} style={{ display: props.displaySearchFields }}>
            <div className={classes.searchIcon}>
              <SearchIcon />
            </div>
            <InputBase
              placeholder="Search category..."
              classes={{
                root: classes.inputRoot,
                input: classes.inputInput
              }}
              id="searchCategory"
              onKeyPress={props.onSearchSubmit}
            />
          </div>
        </Toolbar>
      </AppBar>
    </div>
  );
}

NavigationBar.propTypes = {
  classes: PropTypes.object.isRequired,
  onSearchSubmit: PropTypes.func,
  displaySearchFields: PropTypes.string
};

function mapStateToProps(state) {
    return {
        username: state.userInfo.name
    };
}

function mapDispatchToProps(dispatch, ownProps) {
    return {};
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(NavigationBar));